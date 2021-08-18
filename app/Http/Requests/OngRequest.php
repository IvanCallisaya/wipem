<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OngRequest extends FormRequest
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
            'ciudad'=> 'required|min:4|max:150',
            'direccion'=> 'required|min:4|max:150',
            
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'ciudad.required'=>'La descripción es requerida',
            'direccion.required'=>'La direccion es requerida.',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'ciudad.min'=>'La ciudad debe tener al menos 4 caracteres.',
            'direccion.min'=>'La direccion debe tener al menos 4 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            'ciudad.max'=>'La ciudad debe tener un máximo de 150 caracteres.',
            'direccion.max'=>'La direccion debe tener un máximo de 150 caracteres.',
        ];
    }

}
