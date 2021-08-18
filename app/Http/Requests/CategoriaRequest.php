<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
    public  function rules()
    {
        return [
            'nombre'=> 'required|min:4|max:150',
            'descripcion'=> 'required|min:4|max:150',
            'logo'=> 'required',
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'descripcion.required'=>'La descripción es requerida',
            'logo.required'=>'El logo es requerido.',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'descripcion.min'=>'La descripción debe tener al menos 5 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            'descripcion.max'=>'El nombre debe tener un máximo de 150 caracteres.',
        ];
    }
}
