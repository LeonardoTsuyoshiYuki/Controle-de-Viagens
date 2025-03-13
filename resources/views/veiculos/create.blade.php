<!-- resources/views/veiculos/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Veículo</h1>
    <form action="{{ route('veiculos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo') }}" required>
            @error('modelo')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="ano">Ano</label>
            <input type="number" name="ano" class="form-control @error('ano') is-invalid @enderror" value="{{ old('ano') }}" required>
            @error('ano')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="data_aquisicao">Data de Aquisição</label>
            <input type="date" name="data_aquisicao" class="form-control @error('data_aquisicao') is-invalid @enderror" value="{{ old('data_aquisicao') }}" required>
            @error('data_aquisicao')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="km_aquisicao">KM de Aquisição</label>
            <input type="number" name="km_aquisicao" class="form-control @error('km_aquisicao') is-invalid @enderror" value="{{ old('km_aquisicao') }}" required>
            @error('km_aquisicao')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="renavam">Renavam</label>
            <input type="text" name="renavam" class="form-control @error('renavam') is-invalid @enderror" value="{{ old('renavam') }}" required>
            @error('renavam')
                <span class="invalid-feedback d-block">{{'O renavam já foi cadastrado' }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="placa">Placa</label>
            <input type="text" name="placa" class="form-control @error('placa') is-invalid @enderror" value="{{ old('placa') }}" required>
            @error('placa')
                <span class="invalid-feedback d-block">{{ 'A placa já foi cadastrado' }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Salvar</button>
    </form>
</div>
@endsection
