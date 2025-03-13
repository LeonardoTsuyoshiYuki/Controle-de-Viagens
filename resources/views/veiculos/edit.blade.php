@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Veículo</h1>
    <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $veiculo->modelo) }}" required>
        </div>

        <div class="form-group">
            <label for="ano">Ano</label>
            <input type="number" name="ano" class="form-control" value="{{ old('ano', $veiculo->ano) }}" required>
        </div>

        <div class="form-group">
            <label for="data_aquisicao">Data de Aquisição</label>
            <input type="date" name="data_aquisicao" class="form-control" value="{{ old('data_aquisicao', $veiculo->data_aquisicao->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="km_aquisicao">KM de Aquisição</label>
            <input type="number" name="km_aquisicao" class="form-control" value="{{ old('km_aquisicao', $veiculo->km_aquisicao) }}" required>
        </div>

        <div class="form-group">
            <label for="renavam">Renavam</label>
            <input type="text" name="renavam" class="form-control @error('renavam') is-invalid @enderror" value="{{ old('renavam', $veiculo->renavam) }}" required>
            @error('renavam')
                <span class="invalid-feedback d-block">{{'O renavam já foi cadastrado' }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" name="placa" class="form-control @error('placa') is-invalid @enderror" value="{{ old('placa', $veiculo->placa) }}" required>
            @error('placa')
                <span class="invalid-feedback d-block">{{ 'A placa já foi cadastrado' }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar Alterações</button>
    </form>
</div>
@endsection
