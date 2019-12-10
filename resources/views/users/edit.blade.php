@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Editar Usuário</h3>
        <div class="panel-body">
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="form-horizontal">
            @csrf
            @method("put")
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-sm-3 control-label">Nome do Usuário</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? "form-error" : "" }}" value="{{ $user->name }}">
                    @if($errors->has('name'))
                        <span class="help-block help-error">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? "form-error" : "" }}" value="{{ $user->email }}" autocomplete="email">
                    @if($errors->has('email'))
                        <span class="help-block help-error">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password" class="col-sm-3 control-label">Senha</label>
                <div class="col-sm-6">
                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? "form-error" : "" }}" value="" autocomplete="new-password">
                    @if($errors->has('password'))
                        <span class="help-block help-error">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('passwordconfirm') ? 'has-error' : '' }}">
                <label for="passwordconfirm" class="col-sm-3 control-label">Confirme a senha</label>
                <div class="col-sm-6">
                <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control {{ $errors->has('passwordconfirm') ? "form-error" : "" }}" value="" autocomplete="new-password">
                    @if($errors->has('passwordconfirm'))
                        <span class="help-block help-error">{{ $errors->first('passwordconfirm') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Gravar
                    </button>
                    <a class="btn btn-default" href="{{ route('user.index') }}"><i class="far fa-caret-square-left"></i> Voltar</a>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
