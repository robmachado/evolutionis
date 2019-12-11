@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Editar Projeto</h3>
        <div class="panel-body">
        <form action="{{ route('projeto.update', $model->id) }}" method="POST" class="form-horizontal">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" id="id" name="id" value="{{ $model->id }}">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="nome" class="col-sm-3 control-label">Nome do Projeto</label>
                <div class="col-sm-12">
                    <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? "form-error" : "" }}" value="{{ $model->nome ?? old('nome') }}" required autocomplete="nome">
                    @if($errors->has('nome'))
                        <span class="help-block help-error">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                <label for="descricao" class="col-sm-12 control-label">Descrição do Projeto</label>
                <div class="col-sm-12">
                <textarea name="descricao" id="descricao" rows="2" cols="250" class="form-control {{ $errors->has('descricao') ? "form-error" : "" }}">{{ $model->descricao ?? old('descricao') }}</textarea>
                    @if($errors->has('descricao'))
                        <span class="help-block help-error">{{ $errors->first('descricao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('codigo') ? 'has-error' : '' }}">
                <label for="codigo" class="col-sm-12 control-label">Código do Produto</label>
                <div class="col-sm-12">
                <input type="text" name="codigo" id="codigo" class="form-control {{ $errors->has('codigo') ? "form-error" : "" }}" value="{{ $model->codigo ?? old('codigo') }}" required autocomplete="codigo">
                    @if($errors->has('codigo'))
                        <span class="help-block help-error">{{ $errors->first('codigo') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
            <div class="row">
            <div class="form-group {{ $errors->has('inicio') ? 'has-error' : '' }}">
                <label for="inicio" class="col-sm-12 control-label">Data de Inicio</label>
                <div class="col-sm-12">
                <input type="date" name="inicio" id="inicio" class="form-control {{ $errors->has('inicio') ? "form-error" : "" }}" value="{{ $model->inicio != null ? $model->inicio->format('Y-m-d') : old('inicio') }}">
                    @if($errors->has('inicio'))
                        <span class="help-block help-error">{{ $errors->first('inicio') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('previsao') ? 'has-error' : '' }}">
                <label for="previsao" class="col-sm-12 control-label">Data Prevista</label>
                <div class="col-sm-12">
                <input type="date" name="previsao" id="previsao" class="form-control {{ $errors->has('previsao') ? "form-error" : "" }}" value="{{ $model->previsao != null ? $model->previsao->format('Y-m-d') : old('previsao')  }}">
                    @if($errors->has('previsao'))
                        <span class="help-block help-error">{{ $errors->first('previsao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fim') ? 'has-error' : '' }}">
                <label for="fim" class="col-sm-12 control-label">Data de Encerramento</label>
                <div class="col-sm-12">
                <input type="date" name="fim" id="fim" class="form-control {{ $errors->has('fim') ? "form-error" : "" }}" value="{{ $model->fim != null ? $model->fim->format('Y-m-d') : old('fim') }}">
                    @if($errors->has('fim'))
                        <span class="help-block help-error">{{ $errors->first('fim') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status" class="col-sm-12 control-label">Situação do Projeto</label>
                <div class="col-sm-12">
                    <select id="status" name="status" class="form-control">
                        <option value="0" {{(0 == $model->status ? 'selected': '')}}>Não Iniciado</option>
                        <option value="1" {{(1 == $model->status ? 'selected': '')}}>Em andamento</option>
                        <option value="2" {{(2 == $model->status ? 'selected': '')}}>Finalizado Aprovado</option>
                        <option value="9" {{(9 == $model->status ? 'selected': '')}}>Encerrado Rejeitado</option>
                    </select>
                </div>
            </div>
            </div>
            </div>
            <div class="form-group {{ $errors->has('motivo') ? 'has-error' : '' }}">
                <label for="motivo" class="col-sm-12 control-label">Motivo</label>
                <div class="col-sm-12">
                <textarea name="motivo" id="motivo" rows="2" cols="250" class="form-control {{ $errors->has('motivo') ? "form-error" : "" }}">{{ $model->motivo ?? old('motivo') }}</textarea>
                    @if($errors->has('motivo'))
                        <span class="help-block help-error">{{ $errors->first('motivo') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Gravar
                    </button>
                    <a class="btn btn-default" href="{{ route('projeto.index') }}"><i class="far fa-caret-square-left"></i> Voltar</a>
                </div>
            </div>
        </form>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h3>Tarefas do Projeto</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('task.create', $model->id) }}" class="btn btn-primary float-right actions_create"><i class="far fa-plus-square"></i> Nova Tarefa</a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">Situação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model->tarefas as $tar)
                        <tr>
                           <th scope="row">{{ $tar->id }}</th>
                            <td>{{ $tar->nome }}</td>
                            <td>{{ $tar->responsavel }}</td>
                            <td>{{ $tar->situacao }}</td>
                            <td>
                                <a href="{{ route("tarefa.show", $tar->id) }}" class="actions_show">
                                    <i class="far fa-eye" style="color:#99ffbb"></i>
                                <a>
                                <a href="{{ route("tarefa.edit", $tar->id) }}" class="actions_edit">
                                    <i class="far fa-edit"></i>
                                <a>
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $tar->id }})" data-target="#DeleteModal">
                                    <i class="far fa-trash-alt" style="color:#ff6666;"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('partials.modal')
    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("tarefa.destroy", ":id") }}';
            url = url.replace(':id', id);
            //alert(url);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
