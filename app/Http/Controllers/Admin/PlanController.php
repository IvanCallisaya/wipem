<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Http\Controllers\Controller;


class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plan::get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {   
        $plan = new Plan;
        $plan->create($request->all());
    }


    public function show($plan)
    {
        return Plan::findOrFail($plan);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $data
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request,  $data)
    {   
        $plan = Plan::find($data);
        $plan->nombre = $request['nombre'];
        $plan->descripcion = $request['descripcion'];
        $plan->valor = $request['valor'];
        if(!$plan->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $plan;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy( $data)
    {
        $plan = Plan::find($data);
        $plan->delete();
    }
}