<x-layout title="Vendas">
  @auth
  <a class="btn btn-primary mb-5" href="{{ route('criar.venda') }}">Adicionar Vendas</a>
  @endauth
  @isset($mensagemSucesso)
  <div class="alert alert-success">
    {{ $mensagemSucesso }}
  </div>
  @endisset

  <form action="{{ route('lista.vendas') }}" method="get" class="mb-3">
    <div class="input-group">
      <input type="text" name="produto_pesquisa" class="form-control" placeholder="Pesquisar por produto">
      <button type="submit" class="btn btn-primary">Pesquisar</button>
    </div>
  </form>

  <ul class="list-group">
    <h1>Lista de Vendas</h1>
    @foreach($vendas as $venda)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Vendedor: {{ $venda->client->name }} | Produto: {{ $venda->product }} | Valor: R$ {{ number_format($venda->amount, 2, ',', '.') }} | Total de produtos: {{ $venda->quantity }} | Forma De Pagamento: 
          @if ($venda->payment == 1)
            À vista
          @elseif ($venda->payment == 2)
          Parcelado em: {{ $venda->plots }} vezes de R$ {{ number_format($venda->amount / $venda->plots, 2, ',', '.') }}
          @endif
        </span>
        @auth
        <span class="d-flex">
          <a href="{{ route('generate.pdf', $venda->id) }}" class="btn btn-primary btn-sm">
            <i class='bx bx-down-arrow-alt'> PDF</i>
          </a>
          <a href="{{ route('venda.edit', $venda->id) }}" class="btn btn-success btn-sm ms-2">
            <i class='bx bx-edit'></i>
          </a>
          <form action="{{ route('deletar.venda', $venda->id)}}" method="post" class="ms-2">
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
