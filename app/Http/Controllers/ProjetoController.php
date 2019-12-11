<?php

namespace App\Http\Controllers;

use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjetoRequest;

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
     * @param  \Illuminate\Http\ProjetoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetoRequest $request)
    {
        $data = $request->all();
        if (!empty($request->inicio)) {
            $data['status'] = 1;
        }
        $data['fim'] = null;
        $data['motivo'] = null;
        Projeto::create($data);
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
    public function update($id, ProjetoRequest $request)
    {
        $data = $request->all();

        if ($request->inicio != null && $request->status == 0) {
            $data['status'] = 1;
        }
        //se status = 2 ou 9 e fim = null => usar a data atual
        if ($request->status > 2 && $request->fim == null) {
            notify()->error('Quando indicar a situação de encerramento a data de finalização deve ser indicada!');
            $request->validate([
                'fim' => 'required|date_format:Y-m-d|after:inicio',
                'motivo' => 'required|string'
            ]);
        }
        if (!empty($request->fim) && ($request->status == 0 || $request->status == 1)) {
            notify()->error('Quando indicar data de finalização, a situação também deve ser ajustada!');
            $request->validate([
                'status' => 'integer|min:2|max:9',
                'motivo' => 'required|string'
            ]);
        }
        $model = Projeto::find($id);
        $model->update($data);
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
