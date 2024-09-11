<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Validation\Rule;
class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Imposta su false se vuoi bloccare accessi non autorizzati
    }

    public function rules()
    {
        $role = auth()->user()->role;
        if ($role === 'Paziente') {
            return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'Telefono' => 'required|string|size:10',
            'Genere' => 'required|string|max:1|in:F,M',
            'Indirizzo' => 'nullable|string|max:255',
            'Immagine' => 'nullable|image|max:2048',
            'DataDiNascita' => 'required|date|date_format:Y-m-d'
            ];}

        
            if ($role === 'Clinico') {
            return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'Telefono' => 'required|string|size:10',
            'Genere' => 'required|string|max:1|in:F,M',
            'Indirizzo' => 'nullable|string|max:255',
            'Immagine' => 'nullable|image|max:2048',
            'DataDiNascita' => 'required|date|date_format:Y-m-d'
        ];}

        if ($role === 'Admin') {
            return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'Telefono' => 'required|string|size:10',
            'Genere' => 'required|string|max:1|in:F,M',
            'Indirizzo' => 'nullable|string|max:255',
            'Immagine' => 'nullable|image|max:2048',
            'DataDiNascita' => 'required|date|date_format:Y-m-d',
            'Specializzazione' => 'required|string|max:255',
            'Descrizione' => 'required|string',
            'Ruolo' => 'required|string|in:Medico,Fisioterapista',
        ];
    }
     return[];

    }
}

