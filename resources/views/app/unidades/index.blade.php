<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Valores
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto">

        {{-- Filtros --}}
        <form method="GET" action="{{ route('app.unidades.index') }}" class="mb-4 flex flex-wrap items-end gap-2 bg-gray-50 px-4 py-4 rounded shadow">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1" for="estudio_id">Estudio:</label>
                <select name="estudio_id" id="estudio_id" class="border rounded px-3 py-2">
                    <option value="">Todos</option>
                    @foreach($estudios as $id => $nombre)
                        <option value="{{ $id }}" {{ request('estudio_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1" for="familia_id">Especie:</label>
                <select name="familia_id" id="familia_id" class="border rounded px-3 py-2">
                    <option value="">Todas</option>
                    @foreach($familias as $id => $nombre)
                        <option value="{{ $id }}" {{ request('familia_id') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1" for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="{{ request('titulo') }}"
                       class="border rounded px-3 py-2" placeholder="Título">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1" for="search">Buscar:</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="border rounded px-3 py-2" placeholder="Búsqueda general">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1" for="per_page">Mostrar:</label>
                <select name="per_page" id="per_page" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    <option value="all" {{ $perPage == 1000000 ? 'selected' : '' }}>Todos</option>
                </select>
            </div>
            <div class="flex gap-2 mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filtrar
                </button>
                <a href="{{ route('app.unidades.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                    Limpiar
                </a>
            </div>
        </form>

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('app.unidades.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold shadow transition">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Valor
            </a>
            <span class="text-gray-600 text-sm">Total: {{ $unidades->total() }}</span>
        </div>

        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Estudio</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Especie</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Título</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Analitos</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Valores</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Unidades</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($unidades as $unidad)
                        <tr>
                            <td class="px-4 py-2">{{ $unidad->estudio->estudio ?? '' }}</td>
                            <td class="px-4 py-2">{{ $unidad->familia->familia ?? '' }}</td>
                            <td class="px-4 py-2">{{ $unidad->titulo }}</td>
                            <td class="px-4 py-2">{{ $unidad->nombre }}</td>
                            <td class="px-4 py-2">{{ $unidad->valor }}</td>
                            <td class="px-4 py-2">{{ $unidad->unidad }}</td>
                            <td class="px-4 py-2 flex justify-center space-x-2">
                                <a href="{{ route('app.unidades.edit', $unidad->id) }}"
                                   class="text-blue-500 hover:text-blue-700" title="Editar">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13h3l8-8a2.828 2.828 0 00-4-4l-8 8v3z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('app.unidades.destroy', $unidad->id) }}" class="delete-form inline">
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
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">No hay valores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $unidades->links() }}
        </div>
    </div>

    {{-- SweetAlert2 para confirmar eliminación --}}
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
