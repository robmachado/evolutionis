<?php

namespace App\Http\Controllers;

use App\Projeto;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $models = Projeto::where('status', '<', 2)->paginate(10);
        foreach ($models as $m) {
            $m->espera = number_format($now->diffInDays($m->inicio), 0, '', '.');
        }
        return view('dashboard', compact('models'));
    }
}
