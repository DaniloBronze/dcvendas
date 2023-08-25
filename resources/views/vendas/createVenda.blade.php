<x-layout title="Venda">
  <form action="{{ route('salvar.venda')}}" method="post">
    @csrf
    <div class="mb-3">
        <label for="client_id">Vendedor</label>
        <select class="form-select" id="client_id" name="client_id" aria-label="Floating label select example" autofocus>
          <option value="" selected>Selecione</option>
          @foreach ($clientes as $cliente)
          <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
          @endforeach
        </select>
    </div>

    <div class="row mb-4">
      <div class="col-8">
        <label for="product">Produto</label>
        <select class="form-select" id="product" name="product" aria-label="Floating label select example">
          <option value="" selected>Selecione</option>
          @foreach ($produtos as $produto)
          <option value="{{ $produto->name }}">{{ $produto->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-2">
        <label for="amount">Valor</label>
        <input type="text" name="amount" id="amount" class="form-control">
      </div>
      <div class="col-2">
        <label for="quantity">Quantidade</label>
        <input type="number" name="quantity" id="quantity" class="form-control">
      </div>
    </div>

    <div class="col-8 mb-3">
      <label for="payment">Forma de pagamento</label>
      <select class="form-select" id="payment" name="payment" aria-label="Floating label select example">
        <option value="" selected>Selecione</option>
        <option value="1">À vista</option>
        <option value="2">Parcelado</option>
      </select>
    </div>

    <div class="row mb-2" id="parcelasContainer" style="display: none;">
      <div class="col-2 d-flex align-items-end">
        <input type="text" name="plots" id="plots" class="form-control" placeholder="Parcelas">
      </div>
      <div class="col-2">
        <button type="button" class="btn btn-primary" id="btnCalcularParcelas">Gerar Parcelas</button>
      </div>
    </div>

    <div class="row mb-3" id="installmentsContainer" style="display: none;">
      <div class="col-4">
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @vite(['resources/js/venda.js'])
</x-layout>
