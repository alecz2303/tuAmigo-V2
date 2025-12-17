<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes de Estudios
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto">
        {{-- Filtros --}}
        <form method="GET" action="{{ route('app.solicitudes.index') }}" class="mb-4 flex flex-wrap items-end gap-2 bg-gray-50 px-4 py-4 rounded shadow">
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1" for="folio_interno">Folio Interno:</label>
                <input type="text" name="folios" id="folios" value="{{ request('folios') }}"
                       class="border rounded px-3 py-2" placeholder="Folio Interno">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1" for="folio">Folio:</label>
                <input type="text" name="folio" id="folio" value="{{ request('folio') }}"
                       class="border rounded px-3 py-2" placeholder="Folio">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Fecha Solicitud:</label>
                <div class="flex gap-2">
                    <input type="text" name="fecha_inicio" id="fecha_inicio"
                        value="{{ request('fecha_inicio') }}"
                        class="border rounded px-3 py-2 flatpickr-range" placeholder="Fecha inicio">
                    <input type="text" name="fecha_fin" id="fecha_fin"
                        value="{{ request('fecha_fin') }}"
                        class="border rounded px-3 py-2 flatpickr-range" placeholder="Fecha fin">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1" for="clinica">Clínica:</label>
                <input type="text" name="clinica" id="clinica" value="{{ request('clinica') }}"
                       class="border rounded px-3 py-2" placeholder="Clínica">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1" for="mvz">MVZ:</label>
                <input type="text" name="mvz" id="mvz" value="{{ request('mvz') }}"
                       class="border rounded px-3 py-2" placeholder="MVZ">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1" for="per_page">Mostrar:</label>
                <select name="per_page" id="per_page" class="border rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    <option value="all" {{ request('per_page') == "all" ? 'selected' : '' }}>Todos</option>
                </select>
            </div>
            <div class="flex gap-2 mt-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filtrar
                </button>
                <a href="{{ route('app.solicitudes.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                    Limpiar
                </a>
            </div>
            <div class="flex gap-2 mt-2 ml-auto">
                <a href="{{ route('app.solicitudes.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold shadow transition">
                    <span class="fa fa-plus"></span> Agregar Solicitud
                </a>
            </div>
        </form>

        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Folio Interno</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Folio</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Fecha Solicitud</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">Clínica</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase">MVZ</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($solicitudes as $solicitud)
                        <tr>
                            <td class="px-4 py-2">{{ $solicitud->folios }}</td>
                            <td class="px-4 py-2">{{ $solicitud->folio }}</td>
                            <td class="px-4 py-2">{{ $solicitud->fecha_solicitud }}</td>
                            <td class="px-4 py-2">{{ $solicitud->clinica }}</td>
                            <td class="px-4 py-2">{{ $solicitud->mvz }}</td>
                            <td class="px-4 py-2 flex flex-row space-x-2 justify-center">
                                <!-- Vista previa -->
                                <a href="{{ route('app.solicitudes.show', $solicitud->id) }}"
                                   class="text-gray-500 hover:text-gray-800 px-2 py-1" title="Ver">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <!-- Editar -->
                                <a href="{{ route('app.solicitudes.edit', $solicitud->id) }}"
                                   class="text-blue-500 hover:text-blue-700 px-2 py-1" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <!-- Vista PDF -->
                                <a href="{{ route('app.solicitudes.viewMail', $solicitud->id) }}"
                                   class="text-purple-700 hover:text-purple-900 px-2 py-1" title="Vista PDF" target="_blank">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                <!-- Eliminar con SweetAlert2 -->
                                <form method="POST" action="{{ route('app.solicitudes.destroy', $solicitud->id) }}" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-red-500 hover:text-red-700 px-2 py-1 delete-btn" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay solicitudes registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $solicitudes->links() }}
        </div>
    </div>

    {{-- FontAwesome para los iconos, si tu layout no lo tiene --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    {{-- SweetAlert2 y Flatpickr (si tu layout no los incluye ya) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
        @endif

        @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: "{{ session('warning') }}",
            confirmButtonColor: '#f6c23e'
        });
        @endif

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '{!! implode("<br>", $errors->all()) !!}',
            confirmButtonColor: '#e3342f'
        });
        @endif

        // Flatpickr fechas
        flatpickr("#fecha_inicio", {
            dateFormat: "Y-m-d",
            allowInput: true,
            locale: "es"
        });
        flatpickr("#fecha_fin", {
            dateFormat: "Y-m-d",
            allowInput: true,
            locale: "es"
        });
    });
    </script>
</x-app-layout>
