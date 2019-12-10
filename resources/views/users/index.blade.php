@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>Listagem de Usuários</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('user.create') }}" class="btn btn-primary float-right actions_create"><i class="far fa-plus-square"></i> Cadastrar Novo Usuário</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $m)
                <tr>
                    <td align="center">{{ $m->id }}</td>
                    <td>{{ $m->name }}</td>
                    <td>{{ $m->email }}</td>
                    <td>
                        <a href="{{ route('user.edit', $m->id) }}" class="actions_edit">
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
            var url = '{{ route("user.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@endsection
