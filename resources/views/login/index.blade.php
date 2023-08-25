<x-layout title="Login">
  <form method="post" style="width: 100%;max-width: 500px;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
    @csrf
    <h1 style="text-align: center">Faça seu login</h1>
    <div class="form-group mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
      <label for="password" class="form-label">Senha</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <button class="btn btn-primary mt-3">Entrar</button>

    <a href="{{ route('users.create') }}" class="btn btn-secondary mt-3">
      Registrar
    </a>
  </form>
</div>
</x-layout>
