<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ong;
use Illuminate\Http\Request;
use App\Http\Requests\OngRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class OngController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ong::get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OngRequest $request)
    {   
        $ong = new Ong;
        $ong->create($request->all());
    }


    public function show($ong)
    {
        return Ong::findOrFail($ong);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ong  $data
     * @return \Illuminate\Http\Response
     */
    public function update(OngRequest $request,  $data)
    {   
        $ong = Ong::find($data);
        if ($request->logo <>"") {
            Storage::disk('do')->delete($ong->logo);
            $ong->logo = $request['logo'];
        }
        
        $ong->nombre = $request['nombre'];
        $ong->nit = $request['nit'];
        $ong->ciudad = $request['ciudad'];
        $ong->direccion = $request['direccion'];
        $ong->telefono = $request['telefono'];
        $ong->correo_institucional = $request['correo_institucional'];
        $ong->representante = $request['representante'];
        $ong->correo_representante = $request['correo_representante'];
        $ong->mision = $request['mision'];
        $ong->vision = $request['vision'];
        $ong->cuenta_banco = $request['cuenta_banco'];
        $ong->banco = $request['banco'];
        $ong->tipo_cuenta = $request['tipo_cuenta'];
        if(!$ong->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ong  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy( $data)
    {
        $ong = Ong::find($data);
        $ong->delete();
    }
}