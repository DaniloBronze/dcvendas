<x-layout title="Novo Cliente">
  <x-vendas.form :action="route('salvar.cliente')" :name="old('name')" :update="false"/>
</x-layout>