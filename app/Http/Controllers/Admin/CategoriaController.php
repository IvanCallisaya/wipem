<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categoria;

use App\Http\Requests\CategoriaRequest;
use App\Http\Controllers\Controller;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categoria::get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {   
        $categoria = new Categoria;
        $categoria->create($request->all());
    }


    public function show($categoria)
    {
        return Categoria::findOrFail($categoria);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $data
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request,  $data)
    {   
        $categoria = Categoria::find($data);
        $categoria->nombre = $request['nombre'];
        $categoria->descripcion = $request['descripcion'];
        $categoria->logo = $request['logo'];
        if(!$categoria->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $categoria;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy( $data)
    {
        $categoria = Categoria::find($data);
        $categoria->delete();
    }
}