<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;

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
        $ruta = $request->file('imagen')->store('sponsor', 'public');
        if($request->hasFile('files')) {
            $pictures = [];
            foreach ($request->file('files') as $file) {
                $pathToFile = $file->store('proyectos','public');
                $pictures[] =$pathToFile;

            }
            Images::create([
                'images' => json_encode($pictures),
                'imagen'=> $ruta,
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
