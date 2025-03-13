@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adicionar Viagem</h1>
        <form action="{{ route('viagens.store') }}" method="POST" id="viagem-form">
            @csrf
            <div class="form-group">
                <label for="motorista_id">Motorista</label>
                <select name="motorista_id" id="motorista_id" class="form-control" required>
                    @foreach($motoristas as $motorista)
                        <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="veiculo_id">Veículo</label>
                <select name="veiculo_id" id="veiculo_id" class="form-control" required>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}">{{ $veiculo->modelo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="km_inicial">KM Inicial</label>
                <input type="number" name="km_inicial" id="km_inicial" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="km_final">KM Final</label>
                <input type="number" name="km_final" id="km_final" class="form-control">
            </div>
            <div class="form-group">
            <label for="data_hora_saida">Data e Hora da Viagem</label>
            <input type="datetime-local" name="data_hora_saida" id="data_hora_saida" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data_hora_chegada">Data e Hora de Chegada</label>
                <input type="datetime-local" name="data_hora_chegada" id="data_hora_chegada" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
        </form>
    </div>

    <script>
        // Quando o formulário for enviado, converta as datas para o formato dd/mm/yyyy
        document.getElementById('viagem-form').addEventListener('submit', function(e) {
            var dataViagemInput = document.getElementById('data_viagem');
            var dataChegadaInput = document.getElementById('data_hora_chegada');

            // Converte o valor das datas para o formato dd/mm/yyyy
            var dataViagemValue = dataViagemInput.value;
            var dataChegadaValue = dataChegadaInput.value;

            // Converte data de viagem
            if (dataViagemValue) {
                var dataViagemParts = dataViagemValue.split('T');
                var dataViagemDate = dataViagemParts[0].split('-');
                var dataViagemFormatted = dataViagemDate[2] + '/' + dataViagemDate[1] + '/' + dataViagemDate[0] + ' ' + dataViagemParts[1];
                dataViagemInput.value = dataViagemFormatted;
            }

            // Converte data de chegada
            if (dataChegadaValue) {
                var dataChegadaParts = dataChegadaValue.split('T');
                var dataChegadaDate = dataChegadaParts[0].split('-');
                var dataChegadaFormatted = dataChegadaDate[2] + '/' + dataChegadaDate[1] + '/' + dataChegadaDate[0] + ' ' + dataChegadaParts[1];
                dataChegadaInput.value = dataChegadaFormatted;
            }
        });
    </script>
@endsection 