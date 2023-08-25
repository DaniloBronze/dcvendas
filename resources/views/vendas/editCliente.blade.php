<x-layout title="Editar Cliente {{ $cliente->name }}">
  <x-vendas.form :action="route('clientes.update', $cliente->id)" :name="$cliente->name" :update="true"/>
</x-layout>