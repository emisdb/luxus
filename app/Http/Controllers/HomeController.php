<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('lux.home',['header' => 'Dashboard']);
    }

    public function sorts()
    {
        return view('lux.tree',['header' => 'Variedades']);
    }
    public function clients()
    {
        return view('lux.vew',['header' => 'Clientes']);
    }
    public function plants()
    {
        return view('lux.vew',['header' => 'Fincas']);
    }
    public function misc()
    {
        return view('lux.vew',['header' => 'Cargueras']);
    }
    public function stand()
    {
        return view('lux.vew',['header' => 'Standing']);
    }

}
