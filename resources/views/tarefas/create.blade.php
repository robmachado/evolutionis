@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3>Nova Tarefa de Projeto</h3>
        </div>
        <div class="col-sm-offset-3 col-sm-6">
             <a class="btn btn-default" href="{{ url()->previous() }}"><i class="far fa-caret-square-left"></i> Voltar</a>
        </div>
        </div>
        <div class="panel-body">
        <form action="{{ route('tarefa.store') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                <label for="nome" class="col-sm-3 control-label">Nome da Tarefa</label>
                <div class="col-sm-12">
                    <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? "form-error" : "" }}" value="{{ old('nome') }}" required autocomplete="nome">
                    @if($errors->has('nome'))
                        <span class="help-block help-error">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('projeto_id') ? 'has-error' : '' }}">
                <label for="projeto_id" class="col-sm-12 control-label">Nome do Projeto</label>
                <div class="col-sm-12">
                    <select id="projeto_id" name="projeto_id" class="form-control">
                        @foreach($projetos as $proj)
                            <option value="{{ $proj->id}}"> {{ $proj->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group {{ $errors->has('detalhe') ? 'has-error' : '' }}">
                <label for="detalhe" class="col-sm-12 control-label">Descrição da Tarefa</label>
                <div class="col-sm-12">
                <textarea name="detalhe" id="detalhe" rows="5" cols="250" class="form-control {{ $errors->has('detalhe') ? "form-error" : "" }}" required>{{ old('detalhe') }}</textarea>
                    @if($errors->has('detalhe'))
                        <span class="help-block help-error">{{ $errors->first('detalhe') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('responsavel') ? 'has-error' : '' }}">
                <label for="responsavel" class="col-sm-3 control-label">Responsavel pela Tarefa</label>
                <div class="col-sm-12">
                    <input type="text" name="responsavel" id="responsavel" class="form-control {{ $errors->has('responsavel') ? "form-error" : "" }}" value="{{ old('responsavel') }}" required autocomplete="responsavel">
                    @if($errors->has('responsavel'))
                        <span class="help-block help-error">{{ $errors->first('responsavel') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
            <div class="row">
            <div class="form-group {{ $errors->has('inicio') ? 'has-error' : '' }}">
                <label for="inicio" class="col-sm-12 control-label">Data de Inicio</label>
                <div class="col-sm-12">
                <input type="date" name="inicio" id="inicio" class="form-control {{ $errors->has('inicio') ? "form-error" : "" }}" value="{{ old('inicio') }}">
                    @if($errors->has('inicio'))
                        <span class="help-block help-error">{{ $errors->first('inicio') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('previsao') ? 'has-error' : '' }}">
                <label for="previsao" class="col-sm-12 control-label">Data Prevista Fim</label>
                <div class="col-sm-12">
                <input type="date" name="previsao" id="previsao" class="form-control {{ $errors->has('previsao') ? "form-error" : "" }}" value="{{ old('previsao') }}">
                    @if($errors->has('previsao'))
                        <span class="help-block help-error">{{ $errors->first('previsao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fim') ? 'has-error' : '' }}">
                <label for="fim" class="col-sm-12 control-label">Data de Encerramento</label>
                <div class="col-sm-12">
                <input type="date" name="fim" id="fim" class="form-control {{ $errors->has('fim') ? "form-error" : "" }}" value="{{ old('fim') }}">
                    @if($errors->has('fim'))
                        <span class="help-block help-error">{{ $errors->first('fim') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status" class="col-sm-12 control-label">Situação do Projeto</label>
                <div class="col-sm-12">
                    <select id="status" name="status" class="form-control">
                        <option value="0" selected>Não Iniciado</option>
                        <option value="1">Em andamento</option>
                        <option value="2">Finalizado Aprovado</option>
                        <option value="9">Encerrado Rejeitado</option>
                    </select>
                </div>
            </div>
            </div>
            </div>
            <div class="form-group {{ $errors->has('motivo') ? 'has-error' : '' }}">
                <label for="motivo" class="col-sm-12 control-label">Motivo</label>
                <div class="col-sm-12">
                <textarea name="motivo" id="motivo" rows="2" cols="250" class="form-control {{ $errors->has('motivo') ? "form-error" : "" }}">{{ old('motivo') }}</textarea>
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
                    <a class="btn btn-default" href="{{ url()->previous() }}"><i class="far fa-caret-square-left"></i> Voltar</a>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
