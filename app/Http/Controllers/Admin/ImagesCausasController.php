<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ImagesCausas;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ImagesCausasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = ImagesCausas::orderBy('created_at', 'DESC')->get();
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
                $rutas= Storage::disk('do')->put('imagenes-causas', $file , 'public');
                $pictures[] =$rutas;
                
                // $pictures =Storage::disk('do')->put('file', 'proyectos');
    
            }
            ImagesCausas::create([
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

    public function destroy( $data)
    {
        $imagen = ImagesCausas::find($data);
        $imagen->images = json_decode($imagen->images);
        foreach ($imagen->images as $file) {
            Storage::disk('do')->delete($file);
        }
        $imagen->delete();
    }
}
