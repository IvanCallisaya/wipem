<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ong extends Model
{
  protected $table = "ongs";

    protected $fillable = [
        'nombre',
        'nit',
        'ciudad',
        'direccion',
        'telefono',
        'correo_institucional',
        'representante',
        'correo_representante',
        'mision',
        'vision',
        'logo',
        'cuenta_banco',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
