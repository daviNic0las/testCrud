<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Funcionários Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Lista de Funcionários</h1>
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">Adicionar Funcionário</a>
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
                                <th>Setor</th>
                                <th>Salário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration}}</td>
                                <td class="align-middle">{{ $employee->nomeF}}</td>
                                <td class="align-middle">{{ $employee->setor}}</td>
                                <td class="align-middle">{{ $employee->salario}}</td>
                                <td class="align-middle">
                                        <a href="{{ route('employees.edit', ['id'=>$employee->id]) }}" type="button" class="btn btn-secondary">Editar</a>
                                        <a href="{{ route('employees.delete', ['id'=>$employee->id]) }}" type="button" class="btn btn-danger">Excluir</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="5">Funcionário não encontrado</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>