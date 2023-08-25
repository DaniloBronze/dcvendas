<x-layout title="Editar Produto {{ $produto->name }}">
  <x-vendas.formProduto :action="route('produto.update', $produto->id)" :name="$produto->name" :update="true"/>
</x-layout>