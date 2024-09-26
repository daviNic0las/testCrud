<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Diagnóstico') }}
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

                        <p><a href="{{ route('category.index') }}" class="btn btn-primary mb-4">Voltar</a></p>

                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Nome do Diagnóstico*</label>
                                    <input type="text" name="name" required value="{{ old("name") }}" class="form-control required" placeholder="Nome">
                                    @error('name')
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
