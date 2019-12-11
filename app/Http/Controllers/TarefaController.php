<?php

namespace App\Http\Controllers;

use App\Tarefa;
use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\TarefaRequest;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function index()
    {
        $models = Tarefa::with('projeto')
            ->orderBy('projeto_id')
            ->orderBy('status')
            ->orderBy('inicio')
            ->paginate(10);
        return view('tarefas.index', compact('models'));
    }

    public function newtask($projeto)
    {
        $projetos = Projeto::where('id', $projeto)->get();
        return view('tarefas.create', compact('projetos'));
    }

    public function create()
    {
        $projetos = Projeto::where('status', '<', 2)->orderBy('nome')->get();

        return view('tarefas.create', compact('projetos'));
    }

    public function store(TarefaRequest $request)
    {
        $data = $request->all();
        if (!empty($request->inicio)) {
            $data['status'] = 1;
        }
        $data['fim'] = null;
        $data['motivo'] = null;
        Tarefa::create($data);
        notify()->success('Tarefa criada com sucesso.');
        return redirect()->route('tarefa.index');
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

    public function update($id, TarefaRequest $request)
    {
        $data = $request->all();
        $model = Tarefa::find($id);
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
        //se status = 2 e motivo = null => motivo = Sucesso Aprovado
        //se status = 9 e motivo = null => retorna erro indicar motivo
        if ($request->status == 2 && empty($request->motivo)) {
            $data['motivo'] = 'Sucesso!! Aprovado.';
        } elseif ($request->status == 9 && empty($request->motivo)) {
            notify()->error('Quando indicar o encerramento e REPROVAÇÃO, o motivo deve ser indicado!');
            $request->validate([
                'motivo' => 'required',
            ]);
        }

        $model->update($data);
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
