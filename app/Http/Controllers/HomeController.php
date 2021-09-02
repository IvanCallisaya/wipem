<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function causas()
    {
        return view('causas');
    }

    public function proyecto()
    {
        return view('proyecto');
    }

    public function home()
    {
        return view('home');
    }
    
    
}
