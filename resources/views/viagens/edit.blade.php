@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Viagem</h1>
        <form action="{{ route('viagens.update', $viagem->id) }}" method="POST" id="viagem-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="motorista_id">Motorista</label>
                <select name="motorista_id" id="motorista_id" class="form-control" required>
                    @foreach($motoristas as $motorista)
                        <option value="{{ $motorista->id }}" {{ $motorista->id == $viagem->motorista_id ? 'selected' : '' }}>
                            {{ $motorista->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="veiculo_id">Veículo</label>
                <select name="veiculo_id" id="veiculo_id" class="form-control" required>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}" {{ $veiculo->id == $viagem->veiculo_id ? 'selected' : '' }}>
                            {{ $veiculo->placa }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="km_inicial">KM Inicial</label>
                <input type="number" name="km_inicial" id="km_inicial" class="form-control" 
                    value="{{ $viagem->km_inicial }}" required>
            </div>

            <div class="form-group">
                <label for="km_final">KM Final</label>
                <input type="number" name="km_final" id="km_final" class="form-control" 
                    value="{{ $viagem->km_final }}">
            </div>

            <div class="form-group">
                <label for="data_hora_saida">Data e Hora de Saída</label>
                <input type="datetime-local" name="data_hora_saida" id="data_hora_saida" class="form-control" 
                    value="{{ \Carbon\Carbon::parse($viagem->data_hora_saida)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="form-group">
                <label for="data_hora_chegada">Data e Hora de Chegada</label>
                <input type="datetime-local" name="data_hora_chegada" id="data_hora_chegada" class="form-control" 
                    value="{{ $viagem->data_hora_chegada ? \Carbon\Carbon::parse($viagem->data_hora_chegada)->format('Y-m-d\TH:i') : '' }}">
            </div>

            <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
        </form>
    </div>
@endsection
