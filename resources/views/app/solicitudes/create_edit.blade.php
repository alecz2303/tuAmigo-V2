<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto">
        <form method="POST" action="{{ isset($solicitud) ? route('app.solicitudes.update', $solicitud->id) : route('app.solicitudes.store') }}">
            @csrf
            @if(isset($solicitud))
                @method('PUT')
            @endif

            {{-- Primera fila --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="folios" class="block text-sm font-medium text-gray-700">Folio(s)</label>
                    <input id="folios" name="folios" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('folios', $solicitud->folios ?? '') }}" />
                    @error('folios')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="fecha_solicitud" class="block text-sm font-medium text-gray-700">Fecha de solicitud</label>
                    <input id="fecha_solicitud" name="fecha_solicitud" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2 flatpickr-date"
                        required
                        value="{{ old('fecha_solicitud', $solicitud->fecha_solicitud ?? '') }}" autocomplete="off"/>
                    @error('fecha_solicitud')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="clinica" class="block text-sm font-medium text-gray-700">Clínica</label>
                    <input id="clinica" name="clinica" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('clinica', $solicitud->clinica ?? '') }}" />
                    @error('clinica')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Segunda fila --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="mvz" class="block text-sm font-medium text-gray-700">MVZ</label>
                    <input id="mvz" name="mvz" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('mvz', $solicitud->mvz ?? '') }}" />
                    @error('mvz')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input id="telefono" name="telefono" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('telefono', $solicitud->telefono ?? '') }}" />
                    @error('telefono')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" name="email" type="email"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('email', $solicitud->email ?? '') }}" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tercera fila --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="toma_muestra" class="block text-sm font-medium text-gray-700">Fecha y hora de toma de muestra</label>
                    <input id="toma_muestra" name="toma_muestra" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2 flatpickr-datetime"
                        required
                        value="{{ old('toma_muestra', $solicitud->toma_muestra ?? '') }}" autocomplete="off"/>
                    @error('toma_muestra')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="familia_id" class="block text-sm font-medium text-gray-700">Especie</label>
                    <!-- Select visible pero habilitado -->
                    <select name="familia_id" id="familia_id" class="block mt-1 w-full ..." required>
                        <option value="">-- Selecciona --</option>
                        @foreach($familia_options as $id => $nombre)
                            <option value="{{ $id }}" @if(old('familia_id', $solicitud->familia_id ?? '') == $id) selected @endif>
                                {{ $nombre }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Si está en edición, añade un input oculto -->
                    @if(isset($solicitud))
                        <input type="hidden" name="familia_id" value="{{ $solicitud->familia_id }}">
                    @endif
                    @error('familia_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="id_animal" class="block text-sm font-medium text-gray-700">Identificación del Animal</label>
                    <input id="id_animal" name="id_animal" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('id_animal', $solicitud->id_animal ?? '') }}" />
                    @error('id_animal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Cuarta fila --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="raza" class="block text-sm font-medium text-gray-700">Raza</label>
                    <input id="raza" name="raza" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('raza', $solicitud->raza ?? '') }}" />
                    @error('raza')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                    <select name="sexo" id="sexo" class="block mt-1 w-full rounded border-gray-300 px-2 py-2" required>
                        <option value="">-- Selecciona --</option>
                        <option value="Macho" {{ old('sexo', $solicitud->sexo ?? '') == 'Macho' ? 'selected' : '' }}>Macho</option>
                        <option value="Hembra" {{ old('sexo', $solicitud->sexo ?? '') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                        <option value="Macho Castrado" {{ old('sexo', $solicitud->sexo ?? '') == 'Macho Castrado' ? 'selected' : '' }}>Macho Castrado</option>
                        <option value="Hembra Castrada" {{ old('sexo', $solicitud->sexo ?? '') == 'Hembra Castrada' ? 'selected' : '' }}>Hembra Castrada</option>
                    </select>
                    @error('sexo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="edad" class="block text-sm font-medium text-gray-700">Edad</label>
                    <input id="edad" name="edad" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('edad', $solicitud->edad ?? '') }}" />
                    @error('edad')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Quinta fila --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="propietario" class="block text-sm font-medium text-gray-700">Nombre del Propietario</label>
                    <input id="propietario" name="propietario" type="text"
                        class="mt-1 block w-full border-gray-300 rounded px-2 py-2"
                        required
                        value="{{ old('propietario', $solicitud->propietario ?? '') }}" />
                    @error('propietario')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="estudios" class="block text-sm font-medium text-gray-700">Estudios solicitados</label>
                    @if (!isset($solicitud))
                        <select name="estudios[]" id="estudios" class="block mt-1 w-full rounded border-gray-300 px-2 py-2" required multiple>
                            @foreach($estudio_options as $id => $nombre)
                                <option value="{{ $id }}" {{ (collect(old('estudios', []))->contains($id)) ? 'selected' : '' }}>
                                    {{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="p-2 bg-gray-100 border rounded text-sm">
                            {!! $solicitud->estudios !!}
                        </div>
                    @endif
                    @error('estudios')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Anamnesis y Observaciones --}}
            @if (isset($solicitud))
            <div class="mb-4">
                <label for="observacion" class="block text-sm font-medium text-gray-700">Anamnesis</label>
                <textarea name="observacion" id="observacion" rows="3" class="block w-full rounded border-gray-300">{{ old('observacion', $observacion->observacion ?? '') }}</textarea>
                @error('observacion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif

            @if (isset($solicitud))
            <div class="mb-4">
                <label for="observacion2" class="block text-sm font-medium text-gray-700">Observaciones</label>
                <textarea name="observacion2" id="observacion2" rows="3" class="block w-full rounded border-gray-300">{{ old('observacion2', $observacion->observacion2 ?? '') }}</textarea>
                @error('observacion2')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif

            @if(isset($resultado))
                <div class="my-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-6 border-b pb-2">Resultados</h3>
                    @php
                        $estudioActual = '';
                        $tituloActual = '';
                        $firstTable = true;
                    @endphp
                        @foreach($resultado as $r)
                            {{-- Nuevo Estudio: Título grande azul, separado por margen --}}
                            @if($estudioActual !== $r->estudio)
                                @if(!$firstTable)
                                            </tbody></table>
                                @endif
                                <h4 class="text-xl font-bold text-blue-800 mt-10 mb-4 tracking-wider border-l-4 border-blue-400 pl-3 bg-blue-50 py-2 shadow-sm">
                                    {{ $r->estudio }}
                                </h4>
                                @php $estudioActual = $r->estudio; $tituloActual = ''; $firstTable = false; @endphp
                            @endif

                            {{-- Nuevo Título: Subtítulo y tabla nueva con margen-top --}}
                            @if($tituloActual !== $r->titulo)
                                @if($tituloActual !== '')
                                            </tbody></table>
                                @endif
                                <div class="text-base font-semibold text-gray-700 mb-2 mt-6 uppercase tracking-wide">
                                    {{ $r->titulo }}
                                </div>
                                <div class="overflow-x-auto mb-8">
                                    <table class="min-w-full bg-white border border-gray-300 shadow rounded-lg">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Nombre</th>
                                                <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Valor</th>
                                                <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Resultado</th>
                                                <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Unidad</th>
                                                <th class="px-4 py-2 border-b font-bold text-gray-700 text-center">Negrita</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                @php $tituloActual = $r->titulo; @endphp
                            @endif

                            {{-- FILA DE TABLA --}}
                            <tr class="even:bg-gray-50">
                                <td class="px-4 py-2 border-b">{{ $r->nombre }}</td>
                                <td class="px-4 py-2 border-b">{{ $r->valor }}</td>
                                <td class="px-4 py-2 border-b">
                                    <input type="text" name="resultados[{{ $r->id }}]"
                                        value="{{ old('resultados.'.$r->id, $r->resultado) }}"
                                        class="w-full border-gray-300 rounded px-2 py-1 focus:ring focus:ring-blue-200" />
                                </td>
                                <td class="px-4 py-2 border-b">{{ $r->unidad }}</td>
                                <td class="px-4 py-2 border-b text-center">
                                    <input type="checkbox" name="negrita[{{ $r->id }}]" {{ $r->negrita ? 'checked' : '' }}>
                                </td>
                            </tr>

                            {{-- Cierre de la última tabla --}}
                            @if($loop->last)
                                    </tbody></table>
                            @endif
                        @endforeach
                </div>
            @endif


            <div class="flex items-center mt-6">
                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition"
                >
                    {{ isset($solicitud) ? 'Actualizar' : 'Guardar' }}
                </button>
                <a href="{{ route('app.solicitudes.index') }}"
                    class="ml-4 text-gray-600 hover:text-gray-900 underline"
                >
                    Cancelar
                </a>
                @if(isset($solicitud))
                    <a href="{{ route('app.solicitudes.show', $solicitud->id) }}"
                        target="_blank"
                        class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition"
                    >
                        Vista previa
                    </a>
                @endif
            </div>


        </form>
    </div>

    {{-- Flatpickr CSS/JS --}}
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('.flatpickr-date', {
                dateFormat: 'Y-m-d',
                locale: 'es',
                allowInput: true
            });
            flatpickr('.flatpickr-datetime', {
                enableTime: true,
                dateFormat: 'Y-m-d H:i:S',
                locale: 'es',
                allowInput: true
            });
        });
    </script>
    @endpush

	
</x-app-layout>
