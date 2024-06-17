<x-app-layout>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Funcionário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <h1 class="mb-0">Novo Funcionário</h1>
                        <hr />
                        @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                        @endif

                        <p><a href="{{ route('employee.index') }}" class="btn btn-primary">Voltar</a></p>

                        <form action="{{ route('employee.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Nome do Funcionário*</label>
                                    <input type="text" name="nome" required value="{{ old("nome") }}" class="form-control required" placeholder="Nome">
                                    @error('nome')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3"> 
                                <div class="col">
                                <label class="form-label">Setor do Funcionário*</label>
                                    <input type="text" name="setor" required value="{{ old("setor") }}" class="form-control" placeholder="Setor">
                                    @error('setor')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Salário*</label>
                                    <input type="text" name="salario" required value="{{ old("salario") }}" class="form-control" placeholder="Salário" onInput="mascaraMoeda(event);">
                                    @error('salario')
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