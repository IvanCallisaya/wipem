<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
  protected $table = "sponsors";

    protected $fillable = [
        'nombre',
        'logo',
        'tipo',
    ];
    protected $hidden = ['created_at', 'updated_at'];


}
