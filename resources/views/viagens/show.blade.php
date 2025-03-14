@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Viagem</h1>

        <div class="card">
            <div class="card-body">
                <h6 class="card-subtitle mb-3 text-muted"><strong>Motorista:</strong> {{ $viagem->motorista->nome }}</h6>

                <p class="card-text"><strong>Veículo:</strong> {{ $viagem->veiculo->placa }}</p>
                <p class="card-text"><strong>KM Inicial:</strong> {{ number_format($viagem->km_inicial, 0, ',', '.') }}</p>
                <p class="card-text"><strong>KM Final:</strong> 
                    @if (!is_null($viagem->km_final))
                        {{ number_format($viagem->km_final, 0, ',', '.') }}
                    @else
                        Viagem em andamento
                    @endif
                </p>
                <p class="card-text"><strong>Data e Hora de Início:</strong> 
                    {{ \Carbon\Carbon::parse($viagem->data_hora_saida)->format('d/m/Y H:i') }}
                </p>
                <p class="card-text"><strong>Data e Hora de Chegada:</strong> 
                    @if (!empty($viagem->data_hora_chegada))
                        {{ \Carbon\Carbon::parse($viagem->data_hora_chegada)->format('d/m/Y H:i') }}
                    @else
                        Viagem em andamento
                    @endif
                </p>
            </div>
        </div>

        <a href="{{ route('viagens.index') }}" class="btn btn-primary mt-3">Voltar</a>
    </div>
@endsection
