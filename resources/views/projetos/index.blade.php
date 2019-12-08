@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Projetos/Desenvolvimentos</h3>
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
                <th>Inicio</th>
                <th>Previsão</th>
                <th>Fim</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $m)
                @php
                    $rowcolor = 'color: black';
                    if (!empty($m->data_retorno)) {
                        $rowcolor = 'color: gray';
                    }
                @endphp
                <tr style="{{ $rowcolor }}">
                    <td align="center">{{ $m->id }}</td>
                    <td>{{ $m->maquina->name }}</td>
                    <td>{{ $m->nivel->name }}</td>
                    <td>{{ !empty($m->data_parada) ? $m->data_parada->format('d/m/Y') : null }}</td>
                    <td>{{ !empty($m->data_retorno) ? $m->data_retorno->format('d/m/Y') : null }}</td>
                    <td>
                        <a href="{{ route("corretiva.edit", $m->id) }}" class="actions_edit">
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
            var url = '{{ route("corretiva.destroy", ":id") }}';
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
