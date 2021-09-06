<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proyecto;
use App\Models\ProyectoSponsor;
use Illuminate\Http\Request;
use App\Http\Requests\ProyectoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proyecto::get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectoRequest $request)
    {
        $ruta= Storage::disk('do')->put('proyectos', $request->file('foto_principal') , 'public');
        

        if ($request->hasFile('files')) {
            $pictures = [];
            foreach ($request->file('files') as $file) {
                $rutas= Storage::disk('do')->put('proyectos', $file , 'public');
                $pictures[] = $rutas;
            }
            $proyecto = Proyecto::create([
                'fotos' => json_encode($pictures),
                'foto_principal' => $ruta,
                'nombre' => $request->nombre,
                'video' => $request->video,
                'objetivo' => $request->objetivo,
                'descripcion' => $request->descripcion,
                'fecha_final' => $request->fecha_final,
                'resumen_principal' => $request->resumen_principal,
                'subcategoria_id' => $request->subcategoria_id,
                'plan_id' => $request->plan_id,
                'ong_id' => $request->ong_id,
                'destacado' => $request->destacado,

            ]);
            foreach ($request['sponsor_ids'] as $sponsor_id) {
                ProyectoSponsor::create([
                    'sponsor_id' => $sponsor_id,
                    'proyecto_id' => $proyecto->id,
                ]);
            }
        }
    }


    public function show($ong)
    {
        return Proyecto::findOrFail($ong);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ong  $data
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoRequest $request,  $data)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ong  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        $ong = Proyecto::find($data);
        $ong->delete();
    }

    public function ver($id)
    {

        $proyecto = Proyecto::find($id);
        $proyecto->fotos = json_decode($proyecto->fotos);
        return view('proyecto', compact('proyecto'));
    }


    public function obtenerPaginado($id)
    {
        if ($id == 0) {
            $proyectos = Proyecto::orderBy('created_at', 'desc')->paginate(9);
        } else {
            $proyectos = Proyecto::orderBy('created_at', 'desc')->where('subcategoria_id', $id)->paginate(9);
        }
        return $proyectos;
    }

    public function destacados()
    {
        return Proyecto::where('destacado',1)->get();
            
    }
}
