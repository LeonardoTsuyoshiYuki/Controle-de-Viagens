@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Adicionar Motorista</h1>
        <form id="motorista-form" action="{{ route('motoristas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" required>
                <small id="idade-error" class="text-danger" style="display: none;">O motorista deve ter pelo menos 18 anos.</small>
            </div>
            <div class="form-group">
                <label for="cnh">CNH</label>
                <input type="text" name="cnh" id="cnh" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Salvar</button>
        </form>
    </div>

    <script>
        document.getElementById('motorista-form').addEventListener('submit', function(e) {
            var dataNascimentoInput = document.getElementById('data_nascimento');
            var idadeError = document.getElementById('idade-error');

            var dataNascimento = new Date(dataNascimentoInput.value);
            var hoje = new Date();

            var idade = hoje.getFullYear() - dataNascimento.getFullYear();
            var mes = hoje.getMonth() - dataNascimento.getMonth();
            var dia = hoje.getDate() - dataNascimento.getDate();

            // Ajusta a idade se o mês e dia ainda não passaram
            if (mes < 0 || (mes === 0 && dia < 0)) {
                idade--;
            }

            if (idade < 18) {
                e.preventDefault(); // Impede o envio do formulário
                idadeError.style.display = 'block'; // Exibe a mensagem de erro
            } else {
                idadeError.style.display = 'none'; // Oculta a mensagem de erro se for válida
            }
        });
    </script>
@endsection
