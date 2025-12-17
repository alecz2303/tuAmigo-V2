<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($familia) ? 'Editar Especie' : 'Agregar Especie' }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        {{-- Mostrar errores --}}
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
            action="{{ isset($familia) ? route('app.familias.update', $familia->id) : route('app.familias.store') }}" 
            method="POST"
        >
            @csrf
            @if(isset($familia))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="familia" class="block text-gray-700 font-bold mb-2">Nombre de la Especie:</label>
                <input 
                    type="text" 
                    name="familia" 
                    id="familia" 
                    value="{{ old('familia', $familia->familia ?? '') }}"
                    class="w-full border rounded p-2 @error('familia') border-red-500 @enderror"
                    required
                >
            </div>

            <div class="flex items-center">
                <button 
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    {{ isset($familia) ? 'Actualizar' : 'Guardar' }}
                </button>
                <a href="{{ route('app.familias.index') }}"
                    class="ml-4 text-gray-600 hover:text-gray-900 underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
