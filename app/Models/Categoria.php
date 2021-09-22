<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
  protected $table = "categorias";

    protected $fillable = [
        'nombre',
        'descripcion',
        'logo',
        'slug',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function subcategorias(){
      return $this->hasMany(Subcategoria::class,'categoria_id');
  }
}
