<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  protected $table = "planes";

    protected $fillable = [
        'nombre',
        'descripcion',
        'valor',
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
