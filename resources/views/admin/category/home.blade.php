<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Lista de Categorias</h1>
                        <a href="{{ route('category.create') }}" class="btn btn-primary">Adicionar Categoria</a>
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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration}}</td>
                                <td class="align-middle">{{ $category->nome}}</td>
                                <td class="align-middle">
                                        <a href="{{ route('category.edit', ['id'=>$category->id]) }}" type="button" class="btn btn-warning">Editar</a>
                                        <a href="{{ route('category.delete', ['id'=>$category->id]) }}" type="button" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Categoria não encontrada. Crie uma nova para poder criar seus produtos!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
