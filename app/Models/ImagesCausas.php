<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ImagesCausas extends Model
{
  protected $table = "images_causas";

    protected $fillable = [
        'images',
    ];
    protected $hidden = ['created_at', 'updated_at'];

}