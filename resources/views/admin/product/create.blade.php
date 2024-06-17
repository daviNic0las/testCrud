<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <h1 class="mb-0">Novo Produto</h1>
                        <hr />
                        @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                        @endif

                        <p><a href="{{ route('products.index') }}" class="btn btn-primary">Voltar</a></p>

                        <form action="{{ route('products.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Nome do produto*</label>
                                    <input type="text" name="nome" required value="{{ old("nome") }}" class="form-control required" placeholder="Nome">
                                    @error('nome')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3"> 
                                <div class="col">
                                <label class="form-label">Categoria do produto*</label>
                                    <input type="text" name="categoria" required value="{{ old("categoria") }}" class="form-control" placeholder="Categoria">
                                    @error('categoria')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Valor*</label>
                                    <input type="text" name="valor" required value="{{ old("valor") }}" class="form-control" placeholder="Valor" onInput="mascaraMoeda(event);">
                                    @error('valor')
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