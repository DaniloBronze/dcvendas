<form action="{{ $action }}" method="post">
    @csrf
    @if ($update)
    @method('PUT')
    @endif
    <div class="mb-3">
      <label for="name" class="form-label">Nome do produto:</label>
      <input type="text" id="name" name="name" class="form-control" @isset($name)value="{{ $name }}@endisset">
    </div>
    <div class="mb-3">
      <label for="total" class="form-label">Quantidate do produto:</label>
      <input type="number" id="total" name="total" class="form-control">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Valor do produto:</label>
      <input type="text" id="price" name="price" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>