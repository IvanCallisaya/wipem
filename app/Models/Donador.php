<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Donador extends Model
{
  protected $table = "donador";

    protected $fillable = [
        'nombre',
        'apellido',
        'celular',
        'user_id',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function user()
    {
        return $this->belongsTo( User::class, 'user_id');
    }
}
