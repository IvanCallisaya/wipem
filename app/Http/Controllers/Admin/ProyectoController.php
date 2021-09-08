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
        $proyectos = Proyecto::get();
        $proyectos->load('proyecto_sponsor');
        return $proyectos;
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
            if ($request->plan_id ==0) {
                $request->plan_id =null;
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
                'plan_id' => $request->plan_id ,
                'ong_id' => $request->ong_id,
                'destacado' => $request->destacado,

            ]);
            if($request->sponsor_ids<>0){
                foreach ($proyecto->proyecto_sponsor as $sponsor) {
                    $sponsorAntiguo = ProyectoSponsor::find($sponsor->id);
                    $sponsorAntiguo->delete();
                }
                foreach ($request->sponsor_ids as $sponsor_id) {
                    ProyectoSponsor::create([
                        'sponsor_id' => $sponsor_id,
                        'proyecto_id' => $proyecto->id,
                    ]);
                }
            }
        }
    }


    public function show($ong)
    {
        $proyecto= Proyecto::findOrFail($ong);
        $proyecto->load('proyecto_sponsor');
        return $proyecto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $data)
    {
        $proyecto = Proyecto::find($data);
        $proyecto->load('proyecto_sponsor');
        Storage::disk('do')->delete($proyecto->foto_principal);
        $proyecto->fotos = json_decode($proyecto->fotos);
        foreach ($proyecto->fotos as $file) {
            Storage::disk('do')->delete($file);
        }
        if($request->sponsor_ids<>0){
            foreach ($proyecto->proyecto_sponsor as $sponsor) {
                $sponsorAntiguo = ProyectoSponsor::find($sponsor->id);
                $sponsorAntiguo->delete();
            }
            foreach ($request->sponsor_ids as $sponsor_id) {
                ProyectoSponsor::create([
                    'sponsor_id' => $sponsor_id,
                    'proyecto_id' => $proyecto->id,
                ]);
            }
        }

        $ruta= Storage::disk('do')->put('proyectos', $request->file('foto_principal') , 'public');
        if ($request->hasFile('files')) {
            $pictures = [];
            foreach ($request->file('files') as $file) {
                $rutas= Storage::disk('do')->put('proyectos', $file , 'public');
                $pictures[] = $rutas;
            }
            if ($request->plan_id ==0) {
                $request->plan_id =null;
            }
        $proyecto->nombre = $request->nombre;
        $proyecto->plan_id = $request->plan_id;
        $proyecto->subcategoria_id = $request->subcategoria_id;
        $proyecto->video = $request->video;
        $proyecto->objetivo = $request->objetivo;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_final = $request->fecha_final;
        $proyecto->resumen_principal = $request->resumen_principal;
        $proyecto->destacado = $request['destacado'];
        $proyecto->foto_principal = $ruta;
        $proyecto->fotos = json_encode($pictures);
        }
        if(!$proyecto->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $request;
    }
    public function actualizar(Request $request,  $data)
    {
        $proyecto = Proyecto::find($data);
        $proyecto->load('proyecto_sponsor');
        if ($request->foto_principal <>"") {
            Storage::disk('do')->delete($proyecto->foto_principal);
            $ruta= Storage::disk('do')->put('proyectos', $request->file('foto_principal') , 'public');
            $proyecto->foto_principal = $ruta;
        }
        
        $proyecto->fotos = json_decode($proyecto->fotos);
        foreach ($proyecto->fotos as $file) {
            Storage::disk('do')->delete($file);
        }
        if($request->sponsor_ids<>0){
            foreach ($proyecto->proyecto_sponsor as $sponsor) {
                $sponsorAntiguo = ProyectoSponsor::find($sponsor->id);
                $sponsorAntiguo->delete();
            }
            foreach ($request->sponsor_ids as $sponsor_id) {
                ProyectoSponsor::create([
                    'sponsor_id' => $sponsor_id,
                    'proyecto_id' => $proyecto->id,
                ]);
            }
        }

        
        if ($request->hasFile('files')) {
            $pictures = [];
            foreach ($request->file('files') as $file) {
                $rutas= Storage::disk('do')->put('proyectos', $file , 'public');
                $pictures[] = $rutas;
            }
        $proyecto->nombre = $request->nombre;
        $proyecto->plan_id = $request->plan_id;
        $proyecto->subcategoria_id = $request->subcategoria_id;
        $proyecto->video = $request->video;
        $proyecto->objetivo = $request->objetivo;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_final = $request->fecha_final;
        $proyecto->resumen_principal = $request->resumen_principal;
        $proyecto->destacado = $request['destacado'];
        $proyecto->fotos = json_encode($pictures);
        }
        if(!$proyecto->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $request;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        $proyecto = Proyecto::find($data);
        $proyecto->load('proyecto_sponsor');
        foreach ($proyecto->proyecto_sponsor as $sponsor) {
            $sponsorAntiguo = ProyectoSponsor::find($sponsor->id);
            $sponsorAntiguo->delete();
        }
        Storage::disk('do')->delete($proyecto->foto_principal);
        $proyecto->fotos = json_decode($proyecto->fotos);
        foreach ($proyecto->fotos as $file) {
            Storage::disk('do')->delete($file);
        }
        $proyecto->delete();
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
