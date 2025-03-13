@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Viagens</h1>
        <a href="{{ route('viagens.create') }}" class="btn btn-primary">Adicionar Viagem</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Motorista</th>
                    <th>Veículo</th>
                    <th>KM Inicial</th>
                    <th>KM Final</th>
                    <th>Data e Hora de Início</th>
                    <th>Data e Hora de Chegada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viagens as $viagem)
                    <tr>
                        <td>{{ $viagem->id }}</td>
                        <td>{{ $viagem->motorista->nome }}</td>
                        <td>{{ $viagem->veiculo->placa }}</td>
                        <td>{{ $viagem->km_inicial }}</td>
                        <td>{{ $viagem->km_final }}</td>
                        <td>{{ \Carbon\Carbon::parse($viagem->data_hora_saida)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($viagem->data_hora_chegada)
                                {{ \Carbon\Carbon::parse($viagem->data_hora_chegada)->format('d/m/Y H:i') }}
                            @else
                                Viagem em andamento
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('viagens.show', $viagem->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('viagens.edit', $viagem->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('viagens.destroy', $viagem->id) }}" method="POST" style="display:inline;">
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