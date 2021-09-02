<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProyectoSponsor extends Model
{
  protected $table = "proyecto_sponsor";

    protected $fillable = [
        'proyecto_id',
        'sponsor_id',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function sponsor(){
      return $this->belongsTo(Sponsor::class,'sponsor_id');
  }
  public function proyecto(){
      return $this->belongsTo(Proyecto::class,'proyecto_id');
  }
}
