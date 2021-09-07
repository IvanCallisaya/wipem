<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ImagesProyecto extends Model
{
  protected $table = "images_proyecto";

    protected $fillable = [
        'images',
    ];
    protected $hidden = ['created_at', 'updated_at'];

}