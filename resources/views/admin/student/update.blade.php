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
                    <form action="{{ route('products.update', $products->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <p><a href="{{ route('products.index') }}" class="btn btn-warning mb-4">Voltar</a></p>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nome do Aluno*</label>
                                <input type="text" name="name" required class="form-control" placeholder="Nome"
                                    value="{{$students->name}}">
                                @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Categoria do produto*</label>
                                <select id="category" name="category_id" required class="form-control">
                                    <option value="">Selecione uma Categoria</option>

                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category->id ? 'selected' : ''}}> {{ $category->name }} </option>
                                @empty
                                    <option value="">Nenhuma categoria encontrada</option>
                                @endforelse

                            </select>
                                    @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                    @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Valor*</label>
                            <input type="text" name="valor" required class="form-control" placeholder="Valor"  value="{{$products->valor}}" onInput="mascaraMoeda(event);">
                            @error('valor')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                                <div class="col">
                                <label class="form-label">Atualizar Imagem do Produto*</label>
                                    <input type="file" name="image" class="form-control mb-2">
                                    <img style="width:100px;" src="{{ asset('img/employee').'/'.$products->image }}" alt="Imagem não Carregada">
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
