<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ strip_tags($title) }}</title>
    <style>
        @page { size: letter; margin: 180px 50px; }
        #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; }
        table { border-collapse: collapse; width: 100%; }
        table th, table td { border: 1px solid #888; padding: 4px 6px; font-size: 12px; }
        table th { background-color: #f3f3f3; }
        .red-bold { background: #e3342f; color: #fff; font-weight: bold; padding: 2px 4px; border-radius: 3px; }
        .section-title { margin-top: 18px; color: #444; font-size: 17px; border-bottom: 1px solid #aaa; }
        .small { font-size: 10px; }
        .obs { margin-top: 10px; font-size: 12px; text-align: justify; }
    </style>
</head>
<body>
    <div id="header">
        <table>
            <tr>
                <td align="center">
                    <img src="{{ public_path('images/logota.png') }}" alt="Logo" width="210">
                </td>
            </tr>
            <tr>
                <td align="center">
                    <span class="small">
                        <b>3a. Sur Pte. No. 2322 Col. Penipak Tuxtla Gutiérrez, Chiapas.<br>
                        Tel. 60 267 47 Cel. 961 225 3463</b>
                    </span>
                </td>
            </tr>
        </table>
        <div style="font-size:15px; margin-top:4px; font-weight:bold;">{!! $title !!}</div>
        <hr style="margin: 5px 0;">
    </div>

    <div id="content">
        <table id="solicitud">
            <tr>
                <td><b>Fecha de solicitud:</b> {{ $solicitud->fecha_solicitud }}</td>
                <td><b>Clínica:</b> {{ $solicitud->clinica }}</td>
                <td><b>MVZ:</b> {{ $solicitud->mvz }}</td>
            </tr>
            <tr>
                <td><b>Teléfono:</b> {{ $solicitud->telefono }}</td>
                <td><b>Correo electrónico:</b> {{ $solicitud->email }}</td>
                <td><b>Fecha y hora de toma de muestra:</b> {{ $solicitud->toma_muestra }}</td>
            </tr>
            <tr>
                <td><b>Especie:</b> {{ $familia->familia }}</td>
                <td><b>Identificación del animal:</b> {{ $solicitud->id_animal }}</td>
                <td><b>Raza:</b> {{ $solicitud->raza }}</td>
            </tr>
            <tr>
                <td><b>Sexo:</b> {{ $solicitud->sexo }}</td>
                <td><b>Edad:</b> {{ $solicitud->edad }}</td>
                <td><b>Propietario:</b> {{ $solicitud->propietario }}</td>
            </tr>
            <tr>
                <td><b>Estudios solicitados:</b> {!! $solicitud->estudios !!}</td>
                <td colspan="2"><b>Anamnesis:</b> {{ $observacion->observacion }}</td>
            </tr>
        </table>

        {{-- Resultados --}}
        @php $estudio = $titulo = null; @endphp
        @foreach($resultado as $r)
            @if($estudio !== $r->estudio)
                @if(!is_null($estudio)) </tbody></table> @endif
                <div class="section-title">{{ $r->estudio }}</div>
                @php $estudio = $r->estudio; $titulo = null; @endphp
            @endif
            @if($titulo !== $r->titulo)
                @if(!is_null($titulo)) </tbody></table> @endif
                <div style="margin: 10px 0 2px 0; font-weight:600;">{{ $r->titulo }}</div>
                <table id="resultados">
                    <thead>
                        <tr>
                            <th>Analito</th>
                            <th>Resultado</th>
                            <th>Referencia</th>
                            <th>Unidad</th>
                        </tr>
                    </thead>
                    <tbody>
                @php $titulo = $r->titulo; @endphp
            @endif
            @if($r->resultado !== '')
                <tr>
                    <td>{{ $r->nombre }}</td>
                    <td>
                        @if($r->negrita == 1)
                            <span class="red-bold">{{ $r->resultado }}</span>
                        @else
                            {{ $r->resultado }}
                        @endif
                    </td>
                    <td>{{ $r->valor }}</td>
                    <td>{{ $r->unidad }}</td>
                </tr>
            @endif
            @if($loop->last) </tbody></table> @endif
        @endforeach

        <div class="obs">
            <h3>Observaciones:</h3>
            <div>{{ $observacion->observacion2 }}</div>
        </div>
    </div>

    <div id="footer">
        <hr>
        <p class="small">
            Responsable: <b>M.V.Z. Claudia Maza Santiago</b>
            <i>Cédula Profesional: 4081748</i> <br>
            <img src="{{ public_path('images/firma.png') }}" alt="Firma" width="80">
        </p>
        <small style="font-size:8px;">
            Documento creado el día {{ now()->format('d') }} de
            @php
                $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            @endphp
            {{ $meses[now()->format('m')-1] }} de {{ now()->format('Y') }} a las {{ now()->format('H:i') }} hrs.
        </small>
    </div>
</body>
</html>
