<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight m-bottom">
            {{ __('Lista de Alunos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Tabela Alunos</h1>
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Adicionar Aluno</a>
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
                                <th>Data Nasc.</th>
                                <th>Turma</th>
                                <th>ID</th>
                                <th>Escola</th>
                                <th>Diagnóstico</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <!-- a fazer -->
                                    <td class="align-middle">{{ $loop->iteration}}</td>
                                    <td class="align-middle">{{ $product->nome}}</td>
                                    <td class="align-middle">{{ $product->category->nome }}</td>
                                    <td class="align-middle">{{ $product->valor}}</td>
                                    <td class="align-middle">
                                        <img style="width:50px; height:50px" class="rounded-circle"
                                            src="{{ asset('img/employee/' . $product->image) }}" alt="Image not loaded">
                                    </td>
                                    
                                    <td class="align-middle">
                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" title="Edit products">
                                            <button class="btn btn-warning">
                                                {{ __('Editar') }}
                                            </button>
                                        </a>
 
                                        <form method="POST"
                                            action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Delete products">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="9">Sem alunos cadastrados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
