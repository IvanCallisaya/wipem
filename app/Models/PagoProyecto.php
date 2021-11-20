<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PagoProyecto extends Model
{
  protected $table = "pagos_proyecto";

    protected $fillable = [
        'proyecto_id',
        'donador_id',
        'estado',
        'monto',
        'moneda',
        'fecha',
        'metodo_pago',
        'fecha_confirmacion',
        'fecha_pago',
    ];
    protected $hidden = ['created_at', 'updated_at'];

}
