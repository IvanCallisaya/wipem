<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function handle(Request $request) {
        $pathToFile = $request->file('image')->store('categorias','public');
        return $pathToFile;
    }
    public function ong(Request $request) {
        $pathToFile = $request->file('image')->store('ongs','public');
        return $pathToFile;
    }
}
