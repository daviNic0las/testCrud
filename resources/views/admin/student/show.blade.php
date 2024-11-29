<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Aluno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><a href="{{ route('student.index') }}" class="btn btn-secondary mb-4">Voltar</a></p>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Nome do aluno:</label>
                            <p class="form-control">{{ $student->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Data de Nascimento:</label>
                            <p class="form-control">{{ $student->date_of_birth }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Turma:</label>
                            <p class="form-control">{{ $student->class }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">ID do Aluno:</label>
                            <p class="form-control">{{ $student->student_id }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Escola:</label>
                            <p class="form-control">{{ $student->school }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Diagnóstico do aluno:</label>
                            <p class="form-control">
                                @foreach ($categories as $category)
                                    @if ($student->category_id == $category->id)
                                        {{ $category->name }}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Imagem:</label>
                            <div class="form-control">
                                <img style="width: 100px" src="{{ asset('img/employee/' . $student->image) }}" alt="Imagem não Carregada">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-block">Editar</a>
                                <form method="POST" action="{{ route('student.destroy', $student->id) }}" accept-charset="UTF-8" onsubmit="return confirm('Você tem certeza que deseja deletar este aluno?');" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">Deletar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
