<?php

namespace App\Http\Controllers;

use App\Projeto;
use Carbon\Carbon;

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
        $now = Carbon::now();
        $models = Projeto::where('status', '<', 2)->paginate(10);
        foreach ($models as $m) {
            $m->espera = number_format($now->diffInDays($m->inicio), 0, '', '.');
        }
        return view('home', compact('models'));
    }
}
