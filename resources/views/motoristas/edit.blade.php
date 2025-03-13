@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Motorista</h1>
    <form action="{{ route('motoristas.update', $motorista->id) }}" method="POST" id="motorista-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $motorista->nome) }}" required>
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento', \Carbon\Carbon::parse($motorista->data_nascimento)->format('Y-m-d')) }}" required>
            @error('data_nascimento')
                <span class="invalid-feedback d-block">{{'O motorista deve ser maior de idade.' }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cnh">CNH</label>
            <input type="text" name="cnh" id="cnh" class="form-control" value="{{ old('cnh', $motorista->cnh) }}" required>
        </div>

        <button type="submit" class="btn btn-warning mt-3">Atualizar</button>
    </form>
</div>

<script>
    document.getElementById('motorista-form').addEventListener('submit', function(e) {
        var dataInput = document.getElementById('data_nascimento');
        var erroIdade = document.getElementById('erro-idade');
        var dataNascimento = new Date(dataInput.value);
        var hoje = new Date();
        hoje.setHours(0, 0, 0, 0);

        // Calcula a idade
        var idade = hoje.getFullYear() - dataNascimento.getFullYear();
        var mesAtual = hoje.getMonth();
        var diaAtual = hoje.getDate();
        var mesNascimento = dataNascimento.getMonth();
        var diaNascimento = dataNascimento.getDate();

        // Ajusta a idade se o aniversário ainda não aconteceu no ano atual
        if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
            idade--;
        }
    });
</script>
@endsection
