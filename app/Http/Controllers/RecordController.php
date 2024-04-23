<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Record::all();
        $winner = Record::where('winner', true)->first(); // Obtener al ganador del sorteo
        return view('records.index', compact('participants', 'winner'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = DB::table('records')->pluck('department')->unique();
        return view('records.form', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Definir mensajes personalizados
            $customMessages = [
                'required' => 'El campo :attribute es obligatorio.',
                'string' => 'El campo :attribute debe ser una cadena de caracteres.',
                'max' => 'El campo :attribute no debe superar :max caracteres.',
                'numeric' => 'El campo :attribute solo puede contener números.',
                'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
                'accepted' => 'Debe aceptar los términos y condiciones.',
                'regex'=> 'ingresa un formato valido.',
            ];

            // Validar los datos del formulario con mensajes personalizados
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'id_number' => 'required|numeric|digits:10|',
                'department' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'city' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'cellphone' => 'required|string|digits:10|regex:/^3[0-9]{9}$/|max:255',
                'email' => 'required|email|max:255',
                'habeas_data' => 'required|accepted',
            ], $customMessages);

            // Crear un nuevo registro en la base de datos
            Record::create($validatedData);

            // Redireccionar a la página de agradecimiento
            return redirect()->route('records.index');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }


    public function sorteo(Request $request)
    {
        // Verificar si hay suficientes participantes para realizar el sorteo
        $participantCount = Record::count();
        if ($participantCount < 5) {
            return view('records.selectWinner')->with('error', 'Aún no hay suficientes participantes para realizar el sorteo.');
        }
    
        // Verificar si ya hay un ganador seleccionado
        $existingWinner = Record::where('winner', 1)->first();
        if ($existingWinner) {
            return view('records.selectWinner')->with('error', 'Ya hay un ganador seleccionado en la base de datos.');
        }
    
        // Seleccionar al ganador
        $winner = $this->selectWinner();
    
        // Validar si se seleccionó correctamente al ganador
        if ($winner instanceof Record) {
            return view('records.selectWinner', compact('winner')); // Pasar $winner a la vista
        } else {
            return view('records.selectWinner')->with('error', $winner);
        }
    }
    
    
    public function export()
    {
        // Obtener todos los registros de la base de datos
        $records = Record::all();

        // Definir el nombre del archivo
        $filename = 'registros.csv';

        // Encabezados para el archivo CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        // Generar el contenido del archivo CSV
        $callback = function () use ($records) {
            $file = fopen('php://output', 'w');
            
            // Encabezados
            fputcsv($file, [
                'ID', 
                'Nombre', 
                'Apellido', 
                'Número de identificación', 
                'Departamento', 
                'Ciudad', 
                'Teléfono celular', 
                'Correo electrónico', 
                'Habeas Data', 
                'Creado en', 
                'Actualizado en', 
                'Activo'
            ]);

            // Contenido
            foreach ($records as $record) {
                fputcsv($file, [
                    $record->id,
                    $record->name,
                    $record->last_name,
                    $record->id_number,
                    $record->department,
                    $record->city,
                    $record->cellphone,
                    $record->email,
                    $record->habeas_data,
                    $record->created_at,
                    $record->updated_at,
                    $record->activo
                ]);
            }

            fclose($file);
        };

        // Retornar el archivo CSV como respuesta HTTP
        return response()->stream($callback, 200, $headers);
    }
   

    public function selectWinner()
    {
        // Contar el número de registros
        $count = Record::count();
    
        // Verificar si hay al menos 5 registros
        if ($count < 5) {
            return "Aún no hay suficientes participantes.";
        }
    
        try {
            // Verificar si ya hay un ganador seleccionado
            $existingWinner = Record::where('winner', 1)->first();
            if ($existingWinner) {
                return "Ya hay un ganador seleccionado en la base de datos.";
            }
    
            // Obtener un registro aleatorio
            $winner = Record::inRandomOrder()->first();
    
            // Actualizar el campo 'winner' a 1 para el registro seleccionado
            $winner->winner = 1;
            $winner->save();
    
            return $winner;
        } catch (\Exception $e) {
            return "Error al seleccionar al ganador: " . $e->getMessage();
        }
    }
}
