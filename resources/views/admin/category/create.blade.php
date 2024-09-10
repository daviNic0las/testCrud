<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <h1 class="mb-0">Nova Categoria</h1>
                        <hr />
                        @if (session()->has('error'))
                        <div>
                            {{session('error')}}
                        </div>
                        @endif

                        <p><a href="{{ route('category.index') }}" class="btn btn-primary">Voltar</a></p>

                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Nome da Categoria*</label>
                                    <input type="text" name="nome" required value="{{ old("nome") }}" class="form-control required" placeholder="Nome">
                                    @error('nome')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
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
