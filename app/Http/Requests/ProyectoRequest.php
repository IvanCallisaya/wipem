<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
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

    public  function rules()
    {
        return [
            'nombre'=> 'required|min:4|max:150',
            
            'video'=> 'required|min:4|max:100',
            
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'video.required'=>'La descripción es requerida',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'video.min'=>'La video debe tener al menos 4 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            'video.max'=>'La video debe tener un máximo de 150 caracteres.',
        ];
    }
}
