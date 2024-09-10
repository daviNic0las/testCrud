<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Lista de Produtos</h1>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar Produto</a>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration}}</td>
                                <td class="align-middle">{{ $product->nome}}</td>
                                <td class="align-middle">{{ $product->category->nome }}</td>
                                <td class="align-middle">{{ $product->valor}}</td>
                                <td class="align-middle">
                                        <a href="{{ route('products.edit', ['id'=>$product->id]) }}" type="button" class="btn btn-warning">Editar</a>
                                        <a href="{{ route('products.destroy', ['id'=>$product->id]) }}" type="button" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Produto não encontrado. Lembre-se que é necessário ter alguma categoria antes de poder criar um novo produto!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
