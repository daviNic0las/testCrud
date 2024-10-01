<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar novo Aluno') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        
                        @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                        @endif

                        <p><a href="{{ route('student.index') }}" class="btn btn-primary mb-4">Voltar</a></p>

                        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Nome do aluno*</label>
                                    <input type="text" name="name" required value="{{ old("name") }}" class="form-control required" placeholder="Nome">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Data de Nascimento*</label>
                                    <input type="date" name="date_of_birth" required value="{{ old("date_of_birth") }}" class="form-control required" placeholder="01/01/01">
                                    @error('date_of_birth')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Turma*</label>
                                    <input type="text" name="class" required value="{{ old("class") }}" class="form-control" placeholder="Classe" ">
                                    @error('class')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">ID do Aluno*</label>
                                    <input type="number" name="student_id" required value="{{ old("student_id") }}" class="form-control" placeholder="ID do Aluno" ">
                                    @error('student_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Escola*</label>
                                    <input type="text" name="school" required value="{{ old("school") }}" class="form-control" placeholder="Escola/Instituição" ">
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
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
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
                                    <button class="btn btn-primary">Adicionar</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // onInput="mascaraMoeda(event);
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
