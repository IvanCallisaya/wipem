<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ArticuloRequest extends FormRequest
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
            'description'=> 'required|min:4|max:150',
            'stock'=> 'required',
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'description.required'=>'La descripción es requerida',
            'stock.required'=>'El stock es requerido.',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'description.min'=>'La descripción debe al menos 4 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            'description.max'=>'El nombre debe tener un máximo de 150 caracteres.',
            

            
        ];
    }


}
