<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($estudio) ? 'Editar Estudio' : 'Agregar Estudio' }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        {{-- Mostrar errores de validación --}}
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- El formulario detecta si es edición o creación --}}
        <form 
            action="{{ isset($estudio) ? route('app.estudios.update', $estudio->id) : route('app.estudios.store') }}" 
            method="POST"
        >
            @csrf
            @if(isset($estudio))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="estudio" class="block text-gray-700 font-bold mb-2">Estudio:</label>
                <input 
                    type="text" 
                    name="estudio" 
                    id="estudio" 
                    value="{{ old('estudio', $estudio->estudio ?? '') }}"
                    class="w-full border rounded p-2 @error('estudio') border-red-500 @enderror"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="comentario" class="block text-gray-700 font-bold mb-2">Comentario:</label>
                <input 
                    type="text" 
                    name="comentario" 
                    id="comentario" 
                    value="{{ old('comentario', $estudio->comentario ?? '') }}"
                    class="w-full border rounded p-2 @error('comentario') border-red-500 @enderror"
                >
            </div>

            <div class="flex items-center">
                <button 
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    {{ isset($estudio) ? 'Actualizar' : 'Guardar' }}
                </button>
                <a href="{{ route('app.estudios.index') }}"
                    class="ml-4 text-gray-600 hover:text-gray-900 underline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
