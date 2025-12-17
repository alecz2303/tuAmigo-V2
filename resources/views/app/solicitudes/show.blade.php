<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tu Amigo Laboratorio Clínico</h2>
                <div class="text-gray-600 text-lg mt-1">
                    {{ $title }}
                </div>
                <div class="mt-1 text-sm text-blue-700 font-medium">
                    <i class="fa fa-book"></i> Folio control interno: <span class="font-bold">{{ $solicitud->folios }}</span>
                </div>
            </div>
            <div class="mt-4 sm:mt-0">
                <img src="{{ asset('images/logota.jpg') }}" alt="Logo Tu Amigo" class="w-40 object-contain mx-auto" />
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 py-6 bg-white shadow rounded-lg">
        <form action="{{ url('app/solicitudes/send') }}" method="POST" class="print:hidden">
            @csrf
            <input type="hidden" name="id" value="{{ $solicitud->id }}">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Fecha de solicitud:</label>
                    <div class="text-gray-900">{{ $solicitud->fecha_solicitud }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Clínica:</label>
                    <div class="text-gray-900">{{ $solicitud->clinica }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">MVZ:</label>
                    <div class="text-gray-900">{{ $solicitud->mvz }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Teléfono:</label>
                    <div class="text-gray-900">{{ $solicitud->telefono }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Correo electrónico:</label>
                    <div class="text-gray-900">{{ $solicitud->email }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Fecha y hora de toma de muestra:</label>
                    <div class="text-gray-900">{{ $solicitud->toma_muestra }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Especie:</label>
                    <div class="text-gray-900">{{ $familia->familia }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Identificación del Animal:</label>
                    <div class="text-gray-900">{{ $solicitud->id_animal }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Raza:</label>
                    <div class="text-gray-900">{{ $solicitud->raza }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Sexo:</label>
                    <div class="text-gray-900">{{ $solicitud->sexo }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Edad:</label>
                    <div class="text-gray-900">{{ $solicitud->edad }}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nombre del Propietario:</label>
                    <div class="text-gray-900">{{ $solicitud->propietario }}</div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Estudios solicitados:</label>
                    <div class="text-gray-900">{!! $solicitud->estudios !!}</div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Anamnesis:</label>
                    <div class="text-gray-900">{{ $observacion->observacion }}</div>
                </div>
            </div>

            {{-- RESULTADOS --}}
            <div class="my-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-6 border-b pb-2">Resultados</h3>
                @php
                    $estudioActual = '';
                    $tituloActual = '';
                    $firstTable = true;
                @endphp
                @foreach($resultado as $r)
                    @if($estudioActual !== $r->estudio)
                        @if(!$firstTable)
                                </tbody></table>
                        @endif
                        <h4 class="text-xl font-bold text-blue-800 mt-10 mb-4 tracking-wider border-l-4 border-blue-400 pl-3 bg-blue-50 py-2 shadow-sm">
                            {{ $r->estudio }}
                        </h4>
                        @php $estudioActual = $r->estudio; $tituloActual = ''; $firstTable = false; @endphp
                    @endif

                    @if($tituloActual !== $r->titulo)
                        @if($tituloActual !== '')
                                </tbody></table>
                        @endif
                        <div class="text-base font-semibold text-gray-700 mb-2 mt-6 uppercase tracking-wide">
                            {{ ucfirst($r->titulo) }}
                        </div>
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full bg-white border border-gray-300 shadow rounded-lg">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Analito</th>
                                        <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Resultado</th>
                                        <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Referencia</th>
                                        <th class="px-4 py-2 border-b font-bold text-gray-700 text-left">Unidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                        @php $tituloActual = $r->titulo; @endphp
                    @endif

                    @if($r->resultado != '')
                        <tr class="even:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $r->nombre }}</td>
                            <td class="px-4 py-2 border-b">
                                @if($r->negrita == 1)
									<span class="bg-red-600 text-white font-bold px-2 rounded">
										{{ $r->resultado }}
									</span>
								@else
									<span>{{ $r->resultado }}</span>
								@endif
                            </td>
                            <td class="px-4 py-2 border-b">{{ $r->valor }}</td>
                            <td class="px-4 py-2 border-b">{{ $r->unidad }}</td>
                        </tr>
                    @endif

                    @if($loop->last)
                                </tbody></table>
                    @endif
                @endforeach
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold text-gray-700 mb-1">Observaciones:</label>
                <div class="text-gray-900 min-h-[48px]">{{ $observacion->observacion2 }}</div>
            </div>
            <div class="mt-8 mb-2 p-4 bg-gray-50 rounded shadow">
                <div>
                    <span class="font-bold">Responsable:</span><br>
                    M.V.Z. Claudia Maza Santiago.<br>
                    Cédula Profesional: 4081748
                </div>
            </div>
            <div class="flex gap-4 mt-6 print:hidden">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Enviar Correo
                </button>
                <a href="{{ url('app/solicitudes/'.$solicitud->id.'/mail') }}"
                   target="_blank"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Imprimir
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
