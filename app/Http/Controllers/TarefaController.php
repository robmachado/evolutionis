<?php

namespace App\Http\Controllers;

use App\Tarefa;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function index()
    {
        $models = Tarefa::with('projeto')
            ->orderBy('status')
            ->orderBy('inicio')
            ->paginate(10);
        return view('tarefas.index', compact('models'));
    }

    public function newtask($projeto)
    {
        $projeto = Projeto::findOrFail($projeto);
        return view('tarefas.create', compact('projeto'));
    }

    public function create()
    {
        return view('tarefas.create');
    }

    public function store(Request $request)
    {
        Tarefa::create($request->all());
        notify()->success('Tarefa criada com sucesso.');
        return redirect()->route('tarefas.index');
    }

    public function show($id)
    {
        $model = Tarefa::where('id', $id)->first();
        return view('tarefas.show', compact('model'));
    }

    public function edit($id)
    {
        $model = Tarefa::where('id', $id)->first();
        return view('tarefas.edit', compact('model'));
    }

    public function update($id, Request $request)
    {
        $model = Tarefa::find($id);
        
        $model->update($request->all());
        notify()->success('Tarefa alterada com sucesso.');
        return redirect()->route('projeto.edit', $model->projeto_id);
    }

    public function destroy($id)
    {
        $model = Tarefa::find($id);
        $projeto = Projeto::find($model->projeto_id);
        $user_id = Auth::user()->id;

        if ($projeto->user_id !== $user_id && $user_id !== 1) {
            notify()->error("DELEÇÃO NEGADA !!<br>Apenas o criador do projeto pode remover tarefas.");
            return redirect()->route('tarefa.index');
        }
        $model->delete();
        notify()->success('Tarefa removida com sucesso.');
        $previousRequest = str_replace(url('/'), '', url()->previous());
        if ($previousRequest == '/tarefa') {
            return redirect()->route('tarefa.index');
        }
        return redirect()->route('projeto.edit', $projeto->id);
    }
}
