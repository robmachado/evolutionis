<?php

namespace App\Http\Controllers;

use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{
    /**
     * Display a listing of the projetos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Projeto::with('tarefas')
            ->orderBy('status')
            ->orderBy('inicio')
            ->paginate(10);
        return view('projetos.index', compact('models'));
    }

    public function pendents()
    {
        $models = Projeto::with([
            'tarefa:id,nome,responsavel,fim'
        ])->where('status', "<", 9)->paginate(10);
        return $models;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Projeto::create($request->all());
        notify()->success('Projeto criado com sucesso.');
        return redirect()->route('projeto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projeto  $model
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Projeto::where('id', $id)->first();
        //dd($model);
        return view('projetos.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Projeto::where('id', $id)->first();
        return view('projetos.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //se status = 2 ou 9 e fim = null => usar a data atual
        //se status = 2 e motivo = null => motivo = Sucesso Aprovado
        //se status = 9 e motivo = null => retorna erro indicar motivo
        $model = Projeto::find($id);
        $model->update($request->all());
        notify()->success('Projeto alterado com sucesso.');
        return redirect()->route('projeto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $model = Projeto::find($id);
        if ($model->user_id !== $user_id && $user_id !== 1) {
            notify()->error("DELEÇÃO NEGADA !!<br>Apenas o criador do projeto pode remove-lo.");
            return redirect()->route('projeto.index');
        }
        $model->delete();
        notify()->success('Projeto removido com sucesso.');
        return redirect()->back();
    }

}
