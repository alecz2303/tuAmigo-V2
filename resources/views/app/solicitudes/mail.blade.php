<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ strip_tags($title) }}</title>
    <style>
        @page { size: letter; margin: 40px 32px 85px 32px; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; color: #232323; font-size: 12px; background: #f7fafd; }
        .mainbox { background: #fff; border-radius: 8px; box-shadow: 0 0 4px #eef3fa; padding: 24px 22px 15px 22px;}
        .blue-bar { height: 6px; background: #254aa5; border-radius: 5px 5px 0 0; margin-bottom: 14px;}
        /* Header horizontal */
        .headertable { width: 100%; margin-bottom: 0; }
        .headertable td { vertical-align: middle; }
        .logo { height: 46px;}
        .header-right { text-align: right; }
        .labname { color: #254aa5; font-size: 21px; font-weight: bold; letter-spacing: .5px; }
        .labdata { color: #6d7a8e; font-size: 11.2px;}
        /* Paciente */
        .patient-table { width: 100%; margin: 18px 0 8px 0;}
        .patient-table td { padding: 2.5px 8px 2.5px 0; font-size: 13px;}
        .datolabel { color: #6e7b8f; font-size: 11px; font-weight: 600;}
        .datoval { color: #233046; font-size: 13.2px;}
        /* Sección resumen */
        .resumenbox { background: #f6f8fc; border-radius: 7px; padding: 10px 18px 7px 18px; margin-bottom: 18px; }
        .seclabel { color: #254aa5; font-size: 12px; font-weight: bold;}
        .obs { color: #444; font-size: 12px; margin-top: 7px; }
        /* Resultados */
        .section-title { color: #254aa5; font-size: 15px; font-weight: 700; margin: 18px 0 7px 0; }
        table.results { width: 100%; border-collapse: collapse; margin-bottom: 17px;}
        .results th, .results td { padding: 7px 6px; font-size: 12.3px;}
        .results th { background: #e9f0fb; color: #254aa5; border-bottom: 1.3px solid #d5deef; }
        .results tr { border-bottom: 1px solid #f0f0f4;}
        .highlight { background: #ef4444; color: #fff; font-weight: 700; border-radius: 3px; padding: 2px 7px;}
        /* Footer */
        .footertable { width: 100%; border-top: 2px solid #254aa5; margin-top: 16px; }
        .footertable td { font-size: 11px; color: #666; padding-top: 8px; vertical-align: bottom;}
        .firma-img { height: 31px;}
        .footer-right { text-align: right;}
    </style>
</head>
<body>
    <div class="mainbox">
        <div class="blue-bar"></div>
        <!-- Encabezado -->
        <table class="headertable">
            <tr>
                <td>
                    <img src="{{ public_path('images/logota.png') }}" class="logo" alt="Logo">
                </td>
                <td class="header-right">
                    <div class="labname">Tu Amigo Laboratorio Clínico</div>
                    <div class="labdata">
                        3a. Sur Pte. No. 2322 Col. Penipak, Tuxtla Gtz.<br>
                        Tel. 60 267 47 · Cel. 961 225 3463<br>
                        {{ now()->format('d/m/Y') }}
                    </div>
                </td>
            </tr>
        </table>
        
        <!-- Paciente en dos columnas -->
        <table class="patient-table" style="margin-bottom:10px;">
            <tr>
                <td class="datolabel">Paciente / Animal:</td>
                <td class="datoval">{{ $solicitud->id_animal }}</td>
                <td class="datolabel">Propietario:</td>
                <td class="datoval">{{ $solicitud->propietario }}</td>
                <td class="datolabel">Clínica:</td>
                <td class="datoval">{{ $solicitud->clinica }}</td>
            </tr>
            <tr>
                <td class="datolabel">MVZ:</td>
                <td class="datoval">{{ $solicitud->mvz }}</td>
                <td class="datolabel">Especie:</td>
                <td class="datoval">{{ $familia->familia }}</td>
                <td class="datolabel">Raza:</td>
                <td class="datoval">{{ $solicitud->raza }}</td>
            </tr>
            <tr>
                <td class="datolabel">Sexo:</td>
                <td class="datoval">{{ $solicitud->sexo }}</td>
                <td class="datolabel">Edad:</td>
                <td class="datoval">{{ $solicitud->edad }}</td>
                <td class="datolabel">Teléfono:</td>
                <td class="datoval">{{ $solicitud->telefono }}</td>
            </tr>
            <tr>
                <td class="datolabel">Correo:</td>
                <td class="datoval">{{ $solicitud->email }}</td>
                <td class="datolabel">Fecha de Solicitud:</td>
                <td class="datoval">{{ $solicitud->fecha_solicitud }}</td>
                <td class="datolabel">Toma de muestra:</td>
                <td class="datoval">{{ $solicitud->toma_muestra }}</td>
            </tr>
        </table>

        <!-- Estudios y anamnesis -->
        <div class="resumenbox">
            <span class="seclabel">Estudios solicitados:</span>
            <span class="datoval">{!! $solicitud->estudios !!}</span>
            @if(!empty($observacion->observacion))
                <div class="obs">
                    <span class="seclabel">Anamnesis:</span> {{ $observacion->observacion }}
                </div>
            @endif
        </div>

        {{-- Resultados agrupados --}}
        @php $estudio = $titulo = null; @endphp
        @foreach($resultado as $r)
            @if($estudio !== $r->estudio)
                @if(!is_null($estudio)) </tbody></table> @endif
                <div class="section-title">{{ $r->estudio }}</div>
                @php $estudio = $r->estudio; $titulo = null; @endphp
            @endif
            @if($titulo !== $r->titulo)
                @if(!is_null($titulo)) </tbody></table> @endif
                <div style="font-weight: 600; color: #333; margin: 6px 0 2px 0;">{{ $r->titulo }}</div>
                <table class="results">
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
                            <span class="highlight">{{ $r->resultado }}</span>
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

        @if(!empty($observacion->observacion2))
            <div class="obs" style="margin-top:10px;">
                <span class="seclabel">Observaciones:</span> {{ $observacion->observacion2 }}
            </div>
        @endif

        <!-- FOOTER -->
        <table class="footertable">
            <tr>
                <td style="width:120px;">
                    <img src="{{ public_path('images/firma.png') }}" class="firma-img" alt="Firma">
                </td>
                <td style="text-align:center;">
                    Responsable: <b>M.V.Z. Claudia Maza Santiago</b> <br>
                    <span style="font-size:10px;">Cédula Profesional: 4081748</span>
                </td>
                <td class="footer-right" style="font-size:10px;">
                    Documento generado el 
                    {{ now()->format('d') }}
                    de @php $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre']; @endphp
                    {{ $meses[now()->format('m')-1] }} de {{ now()->format('Y') }}, {{ now()->format('H:i') }} hrs.
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
