<x-layout title="Produto">
  @auth
  <a class="btn btn-primary mb-5" href="{{ route('criar.produto') }}">Adicionar Produtos</a>
  @endauth
  @isset($mensagemSucesso)
  <div class="alert alert-success">
    {{ $mensagemSucesso }}
  </div>
  @endisset
  
  <ul class="list-group">
    <h1>Lista de Produtos</h1>
    @foreach($produtos as $produto)
      <li class="list-group-item d-flex justify-content-between align-items-center"><span>{{ $produto->name }} R$: {{ number_format($produto->price, 2, ',', '.') }} | Total de produtos: {{ $produto->total }}</span>
        @auth
        <span class="d-flex">
          <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-success btn-sm">
            <i class='bx bx-edit'></i>
          </a>
        <form action="{{ route('deletar.produto', $produto->id)}}" method="post" class="ms-2">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">
          X
        </button>
        </form>
        </span>
        @endauth
      </li>
    @endforeach
  </ul>
</x-layout>