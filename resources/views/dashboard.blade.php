@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Projetos Pendentes</h3>
    <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th>Numero</th>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Inicio</th>
                <th>Previsão</th>
                <th>Decorrido</th>
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
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan=5>
                    <table class="table table-sm">
                        <tbody>
                        @foreach($m->tarefas as $t)
                        <tr class="table-warning">
                            <td align="center">{{ $t->id }}</td>
                            <td>{{ $t->nome }}</td>
                            <td>{{ $t->responsavel }}</td>
                            <td align="center">{{ !empty($m->inicio) ? $m->inicio->format('d/m/Y') : '' }}</td>
                        </tr>
                        </tbody>
                        </table>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $models->links() }}
    </div>
</div>
@endsection
