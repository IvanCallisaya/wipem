<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonadorRequest extends FormRequest
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
            'apellido'=> 'required|min:4|max:150',
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'apellido.required'=>'La descripción es requerida',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'apellido.min'=>'La descripción debe tener al menos 5 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            'apellido.max'=>'El nombre debe tener un máximo de 150 caracteres.',
        ];
    }
}
