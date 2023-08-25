<x-layout title="Vendas">
  <div class="container">
    <div class="p-5 rounded bg-light text-dark">
      @auth
        <h1>Bem-Vindo, {{ auth()->user()->name }}</h1>
      @else
        <h1>Bem-Vindo</h1>
      @endauth
      <p class="lead">Adicione seus clientes, vendas e muito mais no sistema DC Vendas</p>
    </div>
  </div>
</x-layout>