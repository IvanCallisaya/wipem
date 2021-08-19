<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
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
            'logo'=> 'required',
        ];
    }

    public  function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'logo.required'=>'El logo es requerido.',
            'nombre.min'=>'El nombre debe tener al menos 4 caracteres.',
            'nombre.max'=>'El nombre debe tener un máximo de 150 caracteres.',
        ];
    }
}
