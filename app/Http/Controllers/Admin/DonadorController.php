<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donador;
        
use App\Http\Requests\DonadorRequest;
use App\Http\Controllers\Controller;


class DonadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donadores= Donador::get();
        $donadores->load('user');
        return $donadores;
    }
    

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonadorRequest $request)
    {   
        $donador = new Donador;
        $donador->create($request->all());
        return $donador;
    }


    public function show($id)
    {
        $donador= Donador::where('user_id', $id)->first();
        
        return $donador;
        
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donador  $data
     * @return \Illuminate\Http\Response
     */
    public function update(DonadorRequest $request,  $data)
    {   
        $donador = Donador::find($data);
        $donador->nombre = $request['nombre'];
        $donador->descripcion = $request['descripcion'];
        if(!$donador->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $donador;
        
    }

    /**
     *
     * @param  \App\Models\Donador  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy( $data)
    {
        $donador = Donador::find($data);
        $donador->delete();
    }
}