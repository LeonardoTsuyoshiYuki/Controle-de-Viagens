@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Veículo</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $veiculo->modelo }} ({{ $veiculo->ano }})</h5>
                <p class="card-text"><strong>Placa:</strong> {{ $veiculo->placa }}</p>
                <p class="card-text"><strong>Renavam:</strong> {{ $veiculo->renavam }}</p>
                <p class="card-text"><strong>Data de Aquisição:</strong> {{ \Carbon\Carbon::parse($veiculo->data_aquisicao)->format('d/m/Y') }}</p>
                <p class="card-text"><strong>KMs na Aquisição:</strong> {{ number_format($veiculo->km_aquisicao, 0, ',', '.') }}</p>
            </div>
        </div>

        <a href="{{ route('veiculos.index') }}" class="btn btn-primary mt-3">Voltar</a>
    </div>
@endsection
