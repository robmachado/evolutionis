<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        dd('tarefa index');
    }

    public function pendents()
    {
        dd('tarefa pendents');
    }

    public function create()
    {
        dd('tarefa create');
    }

    public function store(Request $request)
    {
        dd('tarefa strore');
    }

    public function show($id)
    {
        dd('tarefa show');
    }

    public function edit($id)
    {
        dd('tarefa edit');
    }

    public function update($id, Request $request)
    {
        dd('tarefa update');
    }

    public function destroy($id)
    {
        dd('tarefa destroy');
    }
}
