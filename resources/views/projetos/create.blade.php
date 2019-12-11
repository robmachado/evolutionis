@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Novo Projeto</h3>
        <div class="panel-body">
        <form action="{{ route('projeto.store') }}" method="POST" class="form-horizontal">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="nome" class="col-sm-3 control-label">Nome do Projeto</label>
                <div class="col-sm-12">
                    <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? "form-error" : "" }}" value="{{ old('nome') }}" required autocomplete="nome do projeto">
                    @if($errors->has('nome'))
                        <span class="help-block help-error">{{ $errors->first('nome') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
                <label for="descricao" class="col-sm-12 control-label">Descrição do Projeto</label>
                <div class="col-sm-12">
                <textarea name="descricao" id="descricao" rows="2" cols="250" class="form-control {{ $errors->has('descricao') ? "form-error" : "" }}">{{ old('"descricao') }}</textarea>
                    @if($errors->has('descricao'))
                        <span class="help-block help-error">{{ $errors->first('descricao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('codigo') ? 'has-error' : '' }}">
                <label for="codigo" class="col-sm-12 control-label">Código do Produto</label>
                <div class="col-sm-12">
                <input type="text" name="codigo" id="codigo" class="form-control {{ $errors->has('codigo') ? "form-error" : "" }}" value="{{ old('codigo') }}" required autocomplete="codigo">
                    @if($errors->has('codigo'))
                        <span class="help-block help-error">{{ $errors->first('codigo') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group {{ $errors->has('inicio') ? 'has-error' : '' }}">
                <label for="inicio" class="col-sm-3 control-label">Data de Inicio</label>
                <div class="col-sm-3">
                <input type="date" name="inicio" id="inicio" class="form-control {{ $errors->has('inicio') ? "form-error" : "" }}" value="{{ old('inicio') }}">
                    @if($errors->has('inicio'))
                        <span class="help-block help-error">{{ $errors->first('inicio') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('previsao') ? 'has-error' : '' }}">
                <label for="previsao" class="col-sm-3 control-label">Data Prevista</label>
                <div class="col-sm-3">
                <input type="date" name="previsao" id="previsao" class="form-control {{ $errors->has('previsao') ? "form-error" : "" }}" value="{{ old('previsao') }}">
                    @if($errors->has('previsao'))
                        <span class="help-block help-error">{{ $errors->first('previsao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fim') ? 'has-error' : '' }}">
                <label for="fim" class="col-sm-3 control-label">Data de Encerramento</label>
                <div class="col-sm-3">
                <input type="date" name="fim" id="fim" class="form-control {{ $errors->has('fim') ? "form-error" : "" }}" value="{{ old('fim') }}">
                    @if($errors->has('fim'))
                        <span class="help-block help-error">{{ $errors->first('fim') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status" class="col-sm-3 control-label">Situação do Projeto</label>
                <div class="col-sm-3">
                    <select id="status" name="status" class="form-control">
                        <option value="0" selected>Não Iniciado</option>
                        <option value="1">Em andamento</option>
                        <option value="2">Finalizado Aprovado</option>
                        <option value="9">Encerrado Rejeitado</option>
                    </select>
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
                    <a class="btn btn-default" href="{{ route('projeto.index') }}"><i class="far fa-caret-square-left"></i> Voltar</a>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
