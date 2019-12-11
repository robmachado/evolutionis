@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <h3>Dados da Tarefa de Projeto</h3>
        </div>
        <div class="col-sm-offset-3 col-sm-6">
             <a class="btn btn-default" href="{{ url()->previous() }}"><i class="far fa-caret-square-left"></i> Voltar</a>
        </div>
        </div>
        <div class="panel-body">
        <form action="#" method="POST" class="form-horizontal">
            @csrf
            <input type="hidden" name="projeto_id" id="projeto_id" value="{{ $model->projeto_id }}">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="nome" class="col-sm-3 control-label">Nome da Tarefa</label>
                <div class="col-sm-12">
                    <input type="text" name="nome" id="nome" class="form-control {{ $errors->has('nome') ? "form-error" : "" }}" value="{{ $model->nome }}" required autocomplete="nome">
                    @if($errors->has('nome'))
                        <span class="help-block help-error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('projetoname') ? 'has-error' : '' }}">
                <label for="projetonome" class="col-sm-3 control-label">Nome do Projeto</label>
                <div class="col-sm-12">
                    <input type="text" name="projetonome" id="projetonome" class="form-control {{ $errors->has('nome') ? "form-error" : "" }}" value="{{ $model->projeto->nome }}" readonly>
                    @if($errors->has('projetonome'))
                        <span class="help-block help-error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('detalhe') ? 'has-error' : '' }}">
                <label for="detalhe" class="col-sm-12 control-label">Descrição da Tarefa</label>
                <div class="col-sm-12">
                <textarea name="detalhe" id="detalhe" rows="5" cols="250" class="form-control {{ $errors->has('detalhe') ? "form-error" : "" }}">{{ $model->detalhe }}</textarea>
                    @if($errors->has('detalhe'))
                        <span class="help-block help-error">{{ $errors->first('detalhe') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('responsavel') ? 'has-error' : '' }}">
                <label for="responsavel" class="col-sm-12 control-label">Responsável pela Tarefa</label>
                <div class="col-sm-12">
                <input type="text" name="responsavel" id="responsavel" class="form-control {{ $errors->has('responsavel') ? "form-error" : "" }}" value="{{ $model->responsavel }}">
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
                <input type="date" name="inicio" id="inicio" class="form-control {{ $errors->has('inicio') ? "form-error" : "" }}" value="{{ $model->inicio != null ? $model->inicio->format('Y-m-d') : null }}">
                    @if($errors->has('inicio'))
                        <span class="help-block help-error">{{ $errors->first('inicio') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('previsao') ? 'has-error' : '' }}">
                <label for="previsao" class="col-sm-12 control-label">Data Prevista Fim</label>
                <div class="col-sm-12">
                <input type="date" name="previsao" id="previsao" class="form-control {{ $errors->has('previsao') ? "form-error" : "" }}" value="{{ $model->previsao != null ? $model->previsao->format('Y-m-d') : null }}">
                    @if($errors->has('previsao'))
                        <span class="help-block help-error">{{ $errors->first('previsao') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fim') ? 'has-error' : '' }}">
                <label for="fim" class="col-sm-12 control-label">Data de Encerramento</label>
                <div class="col-sm-12">
                <input type="date" name="fim" id="fim" class="form-control {{ $errors->has('fim') ? "form-error" : "" }}" value="{{ $model->fim != null ? $model->fim->format('Y-m-d') : null }}">
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
                <textarea name="motivo" id="motivo" rows="2" cols="250" class="form-control {{ $errors->has('motivo') ? "form-error" : "" }}">{{ $model->motivo }}</textarea>
                    @if($errors->has('motivo'))
                        <span class="help-block help-error">{{ $errors->first('motivo') }}</span>
                    @endif
                </div>
            </div>
        </form>
        </div>
        <div class="col-sm-offset-3 col-sm-6">
            <a class="btn btn-default" href="{{ url()->previous()  }}"><i class="far fa-caret-square-left"></i> Voltar</a>
        </div>
    </div>
@endsection
