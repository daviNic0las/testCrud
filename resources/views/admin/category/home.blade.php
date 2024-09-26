<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight m-bottom">
            {{ __('Categorias Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Lista de Diagnósticos</h1>
                        <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Adicionar Diagnóstico</a>
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
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}" title="Edit categpries">
                                        <button class="btn btn-warning">
                                                {{ __('Editar') }}
                                        </button>
                                    </a>
 
                                    <form method="POST"
                                        action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Delete categories">
                                                {{ __('Delete') }}
                                            </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Nenhum Diagnóstico encontrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

