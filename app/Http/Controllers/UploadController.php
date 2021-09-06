<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class UploadController extends Controller
{
    public function handle(Request $request) {
        $ruta= Storage::disk('do')->put('categorias', $request->file('image') , 'public');
        return $ruta;
    }
    public function ong(Request $request) {
        $ruta= Storage::disk('do')->put('ongs', $request->file('image') , 'public');
        return $ruta;
    }
    public function sponsor(Request $request) {
        $ruta= Storage::disk('do')->put('sponsors', $request->file('image') , 'public');
        return $ruta;
    }
}
