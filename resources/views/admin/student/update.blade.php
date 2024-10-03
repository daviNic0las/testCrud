<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edição de Aluno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('student.update', $students->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><a href="{{ route('student.index') }}" class="btn btn-warning mb-4">Voltar</a></p>

                        <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Nome do aluno*</label>
                                    <input type="text" name="name" required class="form-control required" placeholder="Nome" value="{{$students->name}}">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Data de Nascimento*</label>
                                    <input type="date" name="date_of_birth" required class="form-control required" placeholder="01/01/01" value="{{$students->date_of_birth}}">
                                    @error('date_of_birth')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Turma*</label>
                                    <input type="text" name="class" required class="form-control" placeholder="Classe" value="{{$students->class}}">
                                    @error('class')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">ID do Aluno*</label>
                                    <input type="number" name="student_id" required class="form-control" placeholder="ID do Aluno" value="{{$students->student_id}}">
                                    @error('student_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Escola*</label>
                                    <input type="text" name="school" required class="form-control" placeholder="Escola/Instituição" value="{{$students->school}}">
                                    @error('school')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3"> 
                                <div class="col">
                                <label class="form-label">Diagnóstico do aluno*</label>
                                    <select id="category" name="category_id" required class="form-control" >
                                        <option value="">Selecione um Diagnóstico</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> 
                                            {{ $category->name }} 
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Enviar Imagem do Produto*</label>
                                    <input type="file" name="image" value="{{ old("image") }}" class="form-control">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-warning">Atualizar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const mascaraMoeda = (event) => {
  const onlyDigits = event.target.value
    .split("")
    .filter(s => /\d/.test(s))
    .join("")
    .padStart(3, "0")
  const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
  event.target.value = maskCurrency(digitsFloat)
}

const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
  return new Intl.NumberFormat(locale, {
    style: 'currency',
    currency
  }).format(valor)
}
</script>
