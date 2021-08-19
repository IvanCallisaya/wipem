<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;



use App\Http\Requests\SponsorRequest;
use App\Http\Controllers\Controller;


class SponsorController extends Controller
{

    public static function index($data)
    {
      return Sponsor::where('tipo',$data)->get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorRequest $request)
    {   
        $sponsor = new Sponsor;
        $sponsor->create($request->all());
    }


    public function show($tipo,$id)
    {
        $sponsor =Sponsor::findOrFail($id);
        return $sponsor;
        
    }


    public function update(SponsorRequest $request,  $id)
    {   
        $sponsor = Sponsor::find($id);
        $sponsor->nombre = $request['nombre'];
        $sponsor->logo = $request['logo'];
        $sponsor->tipo = $request['tipo'];
        
        if(!$sponsor->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$id);
        return $sponsor;
        
    }

    /**
     * Remove the specified resource from storage.
      * @param  String $tipo
     * @param  \App\Models\Sponsor  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $sponsor = Sponsor::find($id);
        $sponsor->delete();
    }
}