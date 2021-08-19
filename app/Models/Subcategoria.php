<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
  use SoftDeletes;
  protected $table = "subcategorias";

    protected $fillable = [
        'nombre',
        'descripcion',
        'logo',
        'categoria_id',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function categoria()
    {
        return $this->belongsTo( Categoria::class, 'categoria_id');
    }
}
