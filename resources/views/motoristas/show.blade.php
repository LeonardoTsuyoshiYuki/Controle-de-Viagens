@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes do Motorista</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $motorista->nome }}</h5>
                <p class="card-text"><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($motorista->data_nascimento)->format('d/m/Y') }}</p>
                <p class="card-text"><strong>CNH:</strong> {{ $motorista->cnh }}</p>
            </div>
        </div>

        <a href="{{ route('motoristas.index') }}" class="btn btn-primary mt-3">Voltar</a>
        </form>
    </div>
@endsection
