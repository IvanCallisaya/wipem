<?php
namespace App\Http\Controllers\Donador;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use App\Models\PagoProyecto;

class PagoProyectoController extends Controller
{

    public static function index($data)
    {

        return PagoProyecto::get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $pagoProyecto = new PagoProyecto;
        return $pagoProyecto->create($request->all());
        
    }


    public function show($id)
    {
        $PagoProyecto =PagoProyecto::findOrFail($id);
        return $PagoProyecto;
        
    }


    public function update(Request $request,  $id)
    {   
        $PagoProyecto = PagoProyecto::find($id);

        $PagoProyecto->nombre = $request['nombre'];
        $PagoProyecto->logo = $request['logo'];
        $PagoProyecto->tipo = $request['tipo'];
        
        if(!$PagoProyecto->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$id);
        return $PagoProyecto;
        
    }

    /**
     * Remove the specified resource from storage.
      * @param  String $tipo
     * @param  \App\Models\PagoProyecto  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $PagoProyecto = PagoProyecto::find($id);
        $PagoProyecto->delete();
    }
}