<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Images::orderBy('created_at', 'DESC')->get();
        foreach($images as $data) {
            $data->images = json_decode($data->images);
        }
        return response()->json(['images' =>$images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $ruta = $request->file('imagen')->store('index', 'do', 'public');
        
         
        if($request->hasFile('files')) {
            $pictures = [];
            foreach ($request->file('files') as $file) {
                $rutas= Storage::disk('do')->put('index', $file , 'public');
                
                $pictures[] =$rutas;
                
                // $pictures =Storage::disk('do')->put('file', 'proyectos');
    
            }
            Images::create([
                'images' => json_encode($pictures),
            ]);
            return response()->json(['message' => 'image added']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
