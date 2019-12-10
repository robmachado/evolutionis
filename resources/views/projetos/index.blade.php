@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Projeto &amp; Desenvolvimento</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('projeto.create') }}" class="btn btn-primary float-right actions_create"><i class="far fa-plus-square"></i> Novo Projeto</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Numero</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>n.tarefas</th>
                <th>Inicio</th>
                <th>Previsão</th>
                <th>Fim</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $m)
                @php
                    $rowcolor = 'color: black';
                    if (!empty($m->fim)) {
                        $rowcolor = 'color: gray';
                    }
                @endphp
                <tr style="{{ $rowcolor }}">
                    <td align="center">{{ $m->id }}</td>
                    <td>{{ $m->codigo }}</td>
                    <td>{{ $m->nome }}</td>
                    <td>{{ $m->descricao }}</td>
                    <td>{{ $m->tarefas->count() }}</td>
                    <td>{{ !empty($m->inicio) ? $m->inicio->format('d/m/Y') : null }}</td>
                    <td>{{ !empty($m->previsao) ? $m->previsao->format('d/m/Y') : null }}</td>
                    <td>{{ !empty($m->fim) ? $m->fim->format('d/m/Y') : null }}</td>
                    <td>
                        <a href="{{ route("projeto.show", $m->id) }}" class="actions_show">
                            <i class="far fa-eye" style="color:#99ffbb"></i>
                        <a>
                        <a href="{{ route("projeto.edit", $m->id) }}" class="actions_edit">
                            <i class="far fa-edit"></i>
                        <a>
                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $m->id }})" data-target="#DeleteModal">
                            <i class="far fa-trash-alt" style="color:#ff6666;"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $models->links() }}
    </div>
    @include('partials.modal')
    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("projeto.destroy", ":id") }}';
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
