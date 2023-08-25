<x-layout title="Usuarios">
  @auth
  <a class="btn btn-primary mb-5" href="{{ route('criar.cliente') }}">Adicionar Usuários</a>
  @endauth
  @isset($mensagemSucesso)
  <div class="alert alert-success">
    {{ $mensagemSucesso }}
  </div>
  @endisset

  <ul class="list-group">
    <h1>Lista de Usuários</h1>
    @foreach($clientes as $cliente)
      <li class="list-group-item d-flex justify-content-between align-items-center"></span>{{ $cliente->name }}
        @auth
        <span class="d-flex">
          <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-success btn-sm">
            <i class='bx bx-edit'></i>
          </a>
        <form action="{{ route('deletar.usuario', $cliente->id) }}" method="post" class="ms-2">
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