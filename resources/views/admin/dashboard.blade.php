<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Painel do Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-align-center ">
                    {{ __("Bem vindo admin") }}
                    <div class="d-block d-flex pt-2">
                    <p><a href="{{route("products.index")}}" class="btn btn-primary mx-1">Produtos</a></p>
                    <p><a href="{{route("products.index")}}" class="btn btn-primary mx-1">Categorias</a></p>
                    <p><a href="{{route("employee.index")}}" class="btn btn-primary mx-1">Funcionários</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
