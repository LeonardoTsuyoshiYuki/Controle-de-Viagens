@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Motoristas</h1>
        <a href="{{ route('motoristas.create') }}" class="btn btn-primary">Adicionar Motorista</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CNH</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($motoristas as $motorista)
                    <tr>
                        <td>{{ $motorista->id }}</td>
                        <td>{{ $motorista->nome }}</td>
                        <td>{{ $motorista->data_nascimento }}</td>
                        <td>{{ $motorista->cnh }}</td>
                        <td>
                            <a href="{{ route('motoristas.show', $motorista->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('motoristas.edit', $motorista->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('motoristas.destroy', $motorista->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
