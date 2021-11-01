<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
  protected $table = "proyectos";

    protected $fillable = [
        'nombre',
        'video',
        'objetivo',
        'descripcion',
        'fecha_final',
        'fotos',
        'foto_principal',
        'resumen_principal',
        'subcategoria_id',
        'plan_id',
        'ong_id',
        'destacado',
        'slug',
        'recaudado',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function proyecto_sponsor(){
      return $this->hasMany(ProyectoSponsor::class,'proyecto_id');
    }
    
  public function getRouteKeyName()
  {
      return 'slug';
  }
  protected $primaryKey = 'slug';
  public $incrementing = false;
}
