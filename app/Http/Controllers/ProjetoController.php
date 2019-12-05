<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the projetos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Projeto::with([
            'tarefa:id,name,status,responsavel'
        ])->orderBy('created_at')->paginate(10);
        return view('projetos.index', compact('models'));
    }

    public function pendents()
    {
        $models = Projeto::with([
            'tarefa:id,name,status,responsavel'
        ])->where('status', "<", 9)->paginate(10);
        return $models;
    }
}
