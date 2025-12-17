<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($unidad) ? 'Editar Valor' : 'Agregar Valor' }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form 
            action="{{ isset($unidad) ? route('app.unidades.update', $unidad->id) : route('app.unidades.store') }}" 
            method="POST"
        >
            @csrf
            @if(isset($unidad))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="estudio_id" class="block text-gray-700 font-bold mb-2">Estudio:</label>
                <select name="estudio_id" id="estudio_id"
                        class="w-full border rounded p-2 @error('estudio_id') border-red-500 @enderror" required>
                    <option value="">Selecciona un estudio</option>
                    @foreach($estudios as $id => $nombre)
                        <option value="{{ $id }}"
                            {{ old('estudio_id', $unidad->estudio_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="familia_id" class="block text-gray-700 font-bold mb-2">Especie:</label>
                <select name="familia_id" id="familia_id"
                        class="w-full border rounded p-2 @error('familia_id') border-red-500 @enderror" required>
                    <option value="">Selecciona una especie</option>
                    @foreach($familias as $id => $nombre)
                        <option value="{{ $id }}"
                            {{ old('familia_id', $unidad->familia_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="titulo" class="block text-gray-700 font-bold mb-2">Título:</label>
                <input 
                    type="text" 
                    name="titulo" 
                    id="titulo" 
                    value="{{ old('titulo', $unidad->titulo ?? '') }}"
                    class="w-full border rounded p-2 @error('titulo') border-red-500 @enderror"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre:</label>
                <input 
                    type="text" 
                    name="nombre" 
                    id="nombre" 
                    value="{{ old('nombre', $unidad->nombre ?? '') }}"
                    class="w-full border rounded p-2 @error('nombre') border-red-500 @enderror"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="valor" class="block text-gray-700 font-bold mb-2">Valor:</label>
                <input 
                    type="text" 
                    name="valor" 
                    id="valor" 
                    value="{{ old('valor', $unidad->valor ?? '') }}"
                    class="w-full border rounded p-2 @error('valor') border-red-500 @enderror"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="unidad" class="block text-gray-700 font-bold mb-2">Unidad:</label>
                <input 
                    type="text" 
                    name="unidad" 
                    id="unidad" 
                    value="{{ old('unidad', $unidad->unidad ?? '') }}"
                    class="w-full border rounded p-2 @error('unidad') border-red-500 @enderror"
                >
            </div>

            <div class="flex items-center">
                <button 
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    {{ isset($unidad) ? 'Actualizar' : 'Guardar' }}
                </button>
                <a href="{{ route('app.unidades.index') }}"
                    class="ml-4 text-gray-600 hover:text-gray-900 underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
