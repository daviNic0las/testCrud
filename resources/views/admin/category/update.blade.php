<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edição de Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Editar Categoria</h1>
                    <hr />
                    <form action="{{ route("category.update", $categories->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <p><a href="{{ route('category.index') }}" class="btn btn-warning">Voltar</a></p>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nome da Categoria*</label>
                            <input type="text" name="nome" required class="form-control" placeholder="Nome"  value="{{$categories->nome}}">
                            @error('nome')
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