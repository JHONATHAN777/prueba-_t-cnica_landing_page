<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'id_number',
        'department',
        'city',
        'cellphone',
        'email',
        'habeas_data',
        'activo'
    ];


    public static $rules = [
        'name' => 'required|regex:/^[a-zA-Z ]+$/|max:255',
        'last_name' => 'required|regex:/^[a-zA-Z ]+$/|max:255',
        'id_number' => 'required|max:255',
        'department' => 'required|max:255',
        'city' => 'required|max:255',
        'cellphone' => 'required|max:255',
        'email' => 'required|email|unique:records,email|max:255',
        'habeas_data' => 'required|boolean',
        'activo' => 'boolean',
    ];

    public static $customMessages = [
        'name.regex' => 'El campo :attribute solo puede contener letras y espacios.',
        'last_name.regex' => 'El campo :attribute solo puede contener letras y espacios.',
        'email.unique' => 'El correo electrónico ya ha sido registrado.',
    ];
}
