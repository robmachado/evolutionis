@extends('layouts.app')
@section('content')
<div class="container">
<h3>Projetos Pendentes</h3>
    <table class="table table-striped">
            <thead>
            <tr>
                <th>Numero</th>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Inicio</th>
                <th>Previsão</th>
                <th>Decorrido</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $m)
                <tr>
                    <td align="center">{{ $m->id }}</td>
                    <td>{{ $m->codigo }}</td>
                    <td>{{ $m->nome }}</td>
                    <td>{{ $m->descricao }}</td>
                    <td align="center">{{ !empty($m->inicio) ? $m->inicio->format('d/m/Y') : '' }}</td>
                    <td align="center">{{ !empty($m->previsao) ? $m->previsao->format('d/m/Y') : '' }}</td>
                    <td align="right">{{ $m->espera ?? ''}} dias</td>
                    <td>
                        <a href="{{ route("projeto.edit", $m->id) }}" class="actions_edit">
                            <i class="far fa-edit"></i>
                        <a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $models->links() }}
    </div>
</div>
@endsection
