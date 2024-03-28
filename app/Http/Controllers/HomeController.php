<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        return view('lux.search',['header' => 'Search']);
    }
    public function search()
    {
        return view('lux.search',['header' => 'Element Search']);
    }
    public function stand()
    {
        return view('lux.search',['header' => 'Advanced Search']);
    }
    public function vue()
    {
        return view('vue.search',['header' => 'Vue Advanced Search']);
    }
    public function noveo()
    {
        return view('nov.index',['header' => 'Task manager']);
    }
    public function task()
    {
        $userId = request('user_id'); // Access the user_id parameter from the request
        $tran = Transaction::where('paid_to', $userId)->sum('amount')-Transaction::where('paid_by', $userId)->sum('amount');
        return view('lux.task',['header' => 'International Service Management', 'model' => json_encode([$userId,$tran])]);
    }

}
