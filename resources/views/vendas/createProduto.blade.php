<x-layout title="Produto">
  <x-vendas.formProduto :action="route('salvar.produto')" :name="old('name')" :price="old('price')" :update="false"/>
</x-layout>