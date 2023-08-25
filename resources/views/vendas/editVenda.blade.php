<x-layout title="Editar Venda {{ $venda->product }}">
  <x-vendas.formVenda
    :action="route('venda.update', $venda->id)"
    :product="$venda->product"
    :id="$venda->client_id"
    :amount="$venda->amount"
    :quantity="$venda->quantity"
    :name="$nomeCliente"
    :update="true"
  />
</x-layout>
