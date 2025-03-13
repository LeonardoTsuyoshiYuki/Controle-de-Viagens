@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Veículos</h1>
    <a href="{{ route('veiculos.create') }}" class="btn btn-primary mb-3">Adicionar Veículo</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Data de Aquisição</th>
                <th>KMs na Aquisição</th>
                <th>Renavam</th>
                <th>Placa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($veiculos as $veiculo)
                <tr>
                    <td>{{ $veiculo->modelo }}</td>
                    <td>{{ $veiculo->ano }}</td>
                    <td>{{ $veiculo->data_aquisicao }}</td>
                    <td>{{ $veiculo->km_aquisicao }}</td>
                    <td>{{ $veiculo->renavam }}</td>
                    <td>{{ $veiculo->placa }}</td>
                    <td>
                        <a href="{{ route('veiculos.show', $veiculo->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
