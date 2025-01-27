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
                        <div>
                            <a href="{{ route('student.create') }}" class="btn btn-primary mb-4">Adicionar Aluno</a>
                            <a href="{{ route('students.export') }}" class="btn btn-secondary mb-4">Exportar Alunos</a>
                        </div>
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
                                <th>Nome</th>
                                <th>Data Nasc.</th>
                                <th>Turma</th>
                                <th>ID do Aluno</th>
                                <th>Escola</th>
                                <th>Diagnóstico</th>
                                <th>Foto</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr data-href="{{ route('student.show', ['student' => $student->id]) }}" style="cursor: pointer;">
                                    <td class="align-middle">{{ $student->name }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</td>
                                    <td class="align-middle">{{ $student->class }}</td>
                                    <td class="align-middle">{{ $student->student_id }}</td>
                                    <td class="align-middle">{{ $student->school }}</td>
                                    <td class="align-middle">{{ $student->category->name }}</td>
                                    <td class="align-middle">
                                        <img style="width:50px; height:50px" class="rounded-circle"
                                            src="{{ asset('img/employee/' . $student->image) }}" alt="Imagem não Carregada">
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('student.edit', ['student' => $student->id]) }}" title="Edit students">
                                            <button class="btn btn-warning">
                                                {{ __('Editar') }}
                                            </button>
                                        </a>

                                        <form method="POST" action="{{ route('student.destroy', ['student' => $student->id]) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Delete students">
                                                {{ __('Deletar') }}
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll("tr[data-href]");
            rows.forEach(row => {
                row.addEventListener("click", function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
</x-app-layout>
