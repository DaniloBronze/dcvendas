<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Paniel de {!! $title !!}</title>
  @vite(['resources/sass/app.scss','resources/js/app.js'])
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-warning text-dark mb-3" aria-label="Third navbar example">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('vendas.index') }}">DC VENDAS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample03">
          <ul class="navbar-nav me-auto mb-2 mb-sm-0">
            @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown03">
                <li><a class="dropdown-item" href="{{ route('criar.cliente') }}">Cadastrar Cliente</a></li>
                <li><a class="dropdown-item" href="{{ route('criar.venda') }}">Cadastrar Venda</a></li>
                <li><a class="dropdown-item" href="{{ route('criar.produto') }}">Cadastrar Produto</a></li>
              </ul>
            </li>
            @endauth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Relatório</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown03">
                <li><a class="dropdown-item" href="{{ route('lista.clientes') }}">Listar Clientes</a></li>
                <li><a class="dropdown-item" href="{{ route('lista.produtos') }}">Listar Produtos</a></li>
                <li><a class="dropdown-item" href="{{ route('lista.vendas') }}">Listar Vendas</a></li>
              </ul>
            </li>
          </ul>
        </div>
        @auth
        <form action="{{ route('logout')}}" method="post">
          @csrf
          <button class="btn btn-dark">Sair</button>
        </form>
        @endauth

        @if(Route::currentRouteName() !== 'login' && !Auth::check())
        <div class="btn btn-dark">
          <a style="color: white" href="{{ route('login') }}">Entrar</a>
        </div>
        @endif
    </nav>
  </header>
  <div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {{ $slot }}
  </div>
</body>
</html>