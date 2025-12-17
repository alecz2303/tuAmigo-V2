<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Especies
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">
        {{-- Buscador --}}
        <form method="GET" action="{{ route('app.familias.index') }}" class="mb-4 flex items-center space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="border rounded px-3 py-2 focus:outline-none focus:ring w-full sm:w-1/3"
                   placeholder="Buscar por nombre de especie">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('app.familias.index') }}" 
                   class="text-gray-500 hover:underline ml-2">Limpiar</a>
            @endif
        </form>

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('app.familias.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold shadow transition">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Especie
            </a>
            <span class="text-gray-600 text-sm">Total: {{ $familias->total() }}</span>
        </div>

        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($familias as $familia)
                        <tr>
                            <td class="px-6 py-4">{{ $familia->familia }}</td>
                            <td class="px-6 py-4 flex justify-center space-x-2">
                                <a href="{{ route('app.familias.edit', $familia->id) }}"
                                   class="text-blue-500 hover:text-blue-700" title="Editar">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('app.familias.destroy', $familia->id) }}" class="delete-form inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 hover:text-red-700 delete-btn" title="Eliminar">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">No hay especies registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $familias->links() }}
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
    </script>
</x-app-layout>
