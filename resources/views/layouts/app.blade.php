<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Frota</title>
    <!-- Adicione seus links de CSS aqui -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Controle de Viagens</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('motoristas.index') }}">Motoristas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('veiculos.index') }}">Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('viagens.index') }}">Viagens</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content') <!-- O conteúdo das páginas será inserido aqui -->
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
