<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subcategoria;

use App\Http\Requests\SubcategoriaRequest;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

        


class SubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
    //  *     * @param  \App\Models\Subcategoria  $data
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Subcategoria::get();

    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoriaRequest $request)
    {   
        $Subcategoria = new Subcategoria;
        $Subcategoria->create($request->all());
    }


    public function show($data)
    {
        if ($data == 'influencer') {
          return 'influencer';
        }else {
          return 'empresa';
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategoria  $data
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoriaRequest $request,  $data)
    {   
        $subcategoria = Subcategoria::find($data);
        if ($request->logo <>"") {
            Storage::disk('do')->delete($subcategoria->logo);
            $subcategoria->logo = $request['logo'];
        }
        $subcategoria->nombre = $request['nombre'];
        $subcategoria->descripcion = $request['descripcion'];
        if(!$subcategoria->update())
            new \Exception('No se ha podido modificar la Carrera en la base de datos. Identificador Nº '.$data);
        return $subcategoria;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategoria  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy( $data)
    {
        $subcategoria = Subcategoria::find($data);
        Storage::disk('do')->delete($subcategoria->logo);
        $subcategoria->delete();
    }
}