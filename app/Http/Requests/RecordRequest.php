<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255', // Cambiado a 'string'
            'department' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'cellphone' => 'required|string|max:255', // Cambiado a 'string'
            'email' => 'required|email|max:255',
            'habeas_data' => 'required|accepted',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'last_name.required' => 'El apellido es obligatorio.',
            'id_number.required' => 'El número de identificación es obligatorio.',
            'department.required' => 'El departamento es obligatorio.',
            'city.required' => 'La ciudad es obligatoria.',
            'cellphone.required' => 'El número de celular es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'habeas_data.required' => 'Debes aceptar el tratamiento de tus datos según la política de protección de datos.',
        ];
    }
}
