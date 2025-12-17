<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Folio;
use App\Models\Resultado;
use App\Models\Observacion;
use App\Models\Estudio;
use App\Models\Familia;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudesController extends Controller
{
    public function index(Request $request)
	{
		$familias = Familia::orderBy('familia')->pluck('familia', 'id');
		$perPage = $request->input('per_page', 10);
		if ($perPage === "all") $perPage = 1000000; else $perPage = (int)$perPage;

		$query = Solicitud::with('familia');

		// Filtros
		if ($request->filled('folios')) {
			$query->where('folios', 'like', "%{$request->folios}%");
		}
		if ($request->filled('folio')) {
			$query->where('folio', 'like', "%{$request->folio}%");
		}
		if ($request->filled('fecha_solicitud')) {
			$query->where('fecha_solicitud', 'like', "%{$request->fecha_solicitud}%");
		}
		if ($request->filled('fecha_inicio')) {
			$query->where('fecha_solicitud', '>=', $request->fecha_inicio);
		}
		if ($request->filled('fecha_fin')) {
			$query->where('fecha_solicitud', '<=', $request->fecha_fin);
		}
		if ($request->filled('clinica')) {
			$query->where('clinica', 'like', "%{$request->clinica}%");
		}
		if ($request->filled('mvz')) {
			$query->where('mvz', 'like', "%{$request->mvz}%");
		}
		if ($request->filled('familia_id')) {
			$query->where('familia_id', $request->familia_id);
		}
		if ($request->filled('propietario')) {
			$query->where('propietario', 'like', "%{$request->propietario}%");
		}

		// Filtro general
		if ($request->filled('search')) {
			$search = $request->input('search');
			$query->where(function($q) use ($search) {
				$q->where('folio', 'like', "%$search%")
				->orWhere('clinica', 'like', "%$search%")
				->orWhere('mvz', 'like', "%$search%")
				->orWhere('telefono', 'like', "%$search%")
				->orWhere('email', 'like', "%$search%")
				->orWhere('propietario', 'like', "%$search%")
				->orWhere('id_animal', 'like', "%$search%")
				->orWhere('raza', 'like', "%$search%")
				->orWhere('sexo', 'like', "%$search%")
				->orWhere('edad', 'like', "%$search%")
				->orWhere('estudios', 'like', "%$search%");
			});
		}

		$solicitudes = $query
			->orderBy('created_at', 'desc')
			->paginate($perPage)
			->withQueryString();

		return view('app.solicitudes.index', compact('solicitudes', 'familias', 'perPage'));
	}


    public function create()
    {
        $title = "Agregar Solicitud";
        $familia_options = Familia::orderBy('familia')->pluck('familia', 'id');
        $estudio_options = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        return view('app.solicitudes.create_edit', compact('title', 'familia_options', 'estudio_options'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fecha_solicitud' => 'required|date',
            'clinica'         => 'nullable|string|max:255',
            'mvz'             => 'nullable|string|max:255',
            'telefono'        => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'toma_muestra'    => 'nullable|string|max:255',
            'familia_id'      => 'required|integer|exists:familias,id',
            'id_animal'       => 'nullable|string|max:255',
            'raza'            => 'nullable|string|max:255',
            'sexo'            => 'nullable|string|max:10',
            'edad'            => 'nullable|string|max:20',
            'propietario'     => 'nullable|string|max:255',
            'estudios'        => 'required|array|min:1',
        ]);
        DB::beginTransaction();
        try {
            // Folio automático
            $folioModel = Folio::find(1);
            $num = $folioModel->folio + 1;
            $num_padded = date("Ymd") . "/" . sprintf("%06d", $num);

            // Guarda solicitud
            $solicitud = new Solicitud($request->except('estudios'));
            $solicitud->folio = $num_padded;

            // Procesar estudios (guardamos string plano para compatibilidad)
            $solicitud->estudios = '';
            foreach ($request->input('estudios') as $estudio_id) {
                $estudio = Estudio::find($estudio_id);
                if ($estudio) {
                    $solicitud->estudios .= $estudio->estudio . "<br>";
                }
            }
            $solicitud->save();

            // Guardar resultados relacionados
            foreach ($request->input('estudios') as $estudio_id) {
                $unidades = Unidad::where('familia_id', $request->input('familia_id'))
                    ->where('estudio_id', $estudio_id)->get();
                $estudio = Estudio::find($estudio_id);
                $familia = Familia::find($request->input('familia_id'));
                foreach ($unidades as $unidad) {
                    $resultado = new Resultado();
                    $resultado->solicitud_id = $solicitud->id;
                    $resultado->estudio = $estudio->estudio ?? '';
                    $resultado->familia = $familia->familia ?? '';
                    $resultado->titulo = $unidad->titulo;
                    $resultado->nombre = $unidad->nombre;
                    $resultado->valor = $unidad->valor;
                    $resultado->unidad = $unidad->unidad;
                    $resultado->resultado = '';
                    $resultado->negrita = 0;
                    $resultado->save();
                }
            }

            // Observaciones
            Observacion::create([
                'solicitud_id' => $solicitud->id,
                'observacion'  => '',
                'observacion2' => '',
            ]);

            // Actualiza folio
            $folioModel->folio = $num;
            $folioModel->save();

            DB::commit();
            return redirect()->route('app.solicitudes.edit', $solicitud->id)
                ->with('success', 'La solicitud se ha agregado correctamente');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al guardar: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $familia = Familia::find($solicitud->familia_id);
        $resultado = Resultado::where('solicitud_id', $id)
            ->where('resultado', '!=', '')
            ->orderBy('estudio', 'asc')
            ->orderByRaw('CASE titulo
                WHEN "Serie Roja" THEN 1
                WHEN "Serie Blanca" THEN 2
                WHEN "Serie Plaquetaria" THEN 3
                WHEN "Mielocitos" THEN 4 END')
            ->orderByRaw('CASE nombre
                WHEN "Hematócrito" THEN 1
                WHEN "Hemoglobina" THEN 2
                WHEN "Eritrocitos" THEN 3
                WHEN "Volumen globular medio (VGM)" THEN 4
                WHEN "Volumen globular medio (VCM)" THEN 4
                WHEN "Hemoglobina globular medio (HGM)" THEN 5
                WHEN "Concentración media de hemoglobina globular (CMHC)" THEN 6
                WHEN "Concentración media de hemoglobina globular" THEN 6
                WHEN "Reticulocitos" THEN 7
                WHEN "Leucocitos totales" THEN 8
                WHEN "Leucocitos" THEN 8
                WHEN "Neutrófilos segmentados" THEN 9
                WHEN "Bandas" THEN 10
                WHEN "Monocitos" THEN 11
                WHEN "Linfocitos" THEN 12
                WHEN "Eosinófilos" THEN 13
                WHEN "Basófilos" THEN 14
                WHEN "Mielocitos" THEN 15 END')
            ->orderBy('id', 'asc')
            ->get();
        
        $observacion = Observacion::where('solicitud_id', $id)->first();
        $title = "Resultados Análisis Clínicos Folio: " . $solicitud->folio;
        $familia_options = Familia::orderBy('familia')->pluck('familia', 'id');
        $estudio_options = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        return view('app.solicitudes.show', compact('familia', 'title', 'familia_options', 'estudio_options', 'solicitud', 'resultado', 'observacion'));
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $resultado = Resultado::where('solicitud_id', $id)
            ->orderBy('estudio', 'asc')
            ->orderByRaw('CASE titulo
                WHEN "Serie Roja" THEN 1
                WHEN "Serie Blanca" THEN 2
                WHEN "Serie Plaquetaria" THEN 3
                WHEN "Mielocitos" THEN 4
                ELSE 99 END')
            ->orderByRaw('CASE nombre
                WHEN "Hematócrito" THEN 1
                WHEN "Hemoglobina" THEN 2
                WHEN "Eritrocitos" THEN 3
                WHEN "Volumen globular medio (VGM)" THEN 4
                WHEN "Volumen globular medio (VCM)" THEN 4
                WHEN "Hemoglobina globular medio (HGM)" THEN 5
                WHEN "Concentración media de hemoglobina globular (CMHC)" THEN 6
                WHEN "Concentración media de hemoglobina globular" THEN 6
                WHEN "Reticulocitos" THEN 7
                WHEN "Leucocitos totales" THEN 8
                WHEN "Leucocitos" THEN 8
                WHEN "Neutrófilos segmentados" THEN 9
                WHEN "Bandas" THEN 10
                WHEN "Monocitos" THEN 11
                WHEN "Linfocitos" THEN 12
                WHEN "Eosinófilos" THEN 13
                WHEN "Basófilos" THEN 14
                WHEN "Mielocitos" THEN 15
                ELSE 99 END')
            ->orderBy('id', 'asc') // <-- agrega este ordenamiento final
            ->get();
        // dd($resultado);
        $observacion = Observacion::where('solicitud_id', $id)->first();
        $title = "Editar Solicitud Folio: " . $solicitud->folio;
        $familia_options = Familia::orderBy('familia')->pluck('familia', 'id');
        $estudio_options = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        return view('app.solicitudes.create_edit', compact('title', 'familia_options', 'estudio_options', 'solicitud', 'resultado', 'observacion'));
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $request->validate([
            'fecha_solicitud' => 'required|date',
            'clinica'         => 'nullable|string|max:255',
            'mvz'             => 'nullable|string|max:255',
            'telefono'        => 'nullable|string|max:30',
            'email'           => 'nullable|email|max:255',
            'toma_muestra'    => 'nullable|string|max:255',
            'familia_id'      => 'required|integer|exists:familias,id',
            'id_animal'       => 'nullable|string|max:255',
            'raza'            => 'nullable|string|max:255',
            'sexo'            => 'nullable|string|max:10',
            'edad'            => 'nullable|string|max:20',
            'propietario'     => 'nullable|string|max:255',
        ]);
        
        // Actualiza resultados
        if ($request->has('resultados')) {
            foreach ($request->input('resultados') as $key => $value) {
                $resultado = Resultado::find($key);
                if ($resultado) {
                    $resultado->resultado = isset($value) ? $value : '';
                    $resultado->save();
                }
            }
        }
        
        // Lógica de negrita
        $resultados = Resultado::where('solicitud_id', $id)->get();
        foreach ($resultados as $r) {
            $r->negrita = 0;
            $r->save();
        }
        
        if ($request->has('negrita')) {
            foreach ($request->input('negrita') as $key => $value) {
                $resultado = Resultado::find($key);
                if ($resultado) {
                    $resultado->negrita = 1;
                    $resultado->save();
                }
            }
        }
        // Observaciones
        if ($request->has('observacion')) {
            $observacion = Observacion::firstOrCreate(
                ['solicitud_id' => $id]
            );
            $observacion->observacion = $request->filled('observacion') ? $request->input('observacion') : '';
            $observacion->observacion2 = $request->filled('observacion2') ? $request->input('observacion2') : '';
            $observacion->save();
        }

        // Actualiza solicitud principal
        $solicitud->update($request->except(['resultados', 'observacion', 'observacion2', 'negrita']));

        return redirect()->route('app.solicitudes.edit', $id)
            ->with('success', 'La solicitud se ha actualizado correctamente');
    }

    public function destroy($id)
    {
        Solicitud::destroy($id);
        Resultado::where('solicitud_id', $id)->delete();
        Observacion::where('solicitud_id', $id)->delete();
        return redirect()->route('app.solicitudes.index')->with('warning', 'La solicitud y sus resultados se han eliminado.');
    }

    public function viewMail($id)
    {
        // Busca la solicitud y relaciones
        $solicitud = Solicitud::findOrFail($id);
        $familia = Familia::find($solicitud->familia_id);

        $resultado = Resultado::where('solicitud_id', $id)
            ->where('resultado', '!=', '')
            ->orderBy('estudio', 'asc')
            ->orderByRaw('
                CASE titulo WHEN "Serie Roja" THEN 1
                            WHEN "Serie Blanca" THEN 2
                            WHEN "Serie Plaquetaria" THEN 3
                            WHEN "Mielocitos" THEN 4
                END
            ')
            ->orderByRaw('
                CASE nombre WHEN "Hematócrito" THEN 1
                            WHEN "Hemoglobina" THEN 2
                            WHEN "Eritrocitos" THEN 3
                            WHEN "Volumen globular medio (VGM)" THEN 4
                            WHEN "Volumen globular medio (VCM)" THEN 4
                            WHEN "Hemoglobina globular medio (HGM)" THEN 5
                            WHEN "Concentración media de hemoglobina globular (CMHC)" THEN 6
                            WHEN "Concentración media de hemoglobina globular" THEN 6
                            WHEN "Reticulocitos" THEN 7
                            WHEN "Leucocitos totales" THEN 8
                            WHEN "Leucocitos" THEN 8
                            WHEN "Neutrófilos segmentados" THEN 9
                            WHEN "Bandas" THEN 10
                            WHEN "Monocitos" THEN 11
                            WHEN "Linfocitos" THEN 12
                            WHEN "Eosinófilos" THEN 13
                            WHEN "Basófilos" THEN 14
                            WHEN "Mielocitos" THEN 15
                END
            ')
            ->orderBy('id', 'asc')
            ->get();

        $observacion = Observacion::where('solicitud_id', $id)->first();
        $title = 'Resultados Análisis Clínicos Folio: <b>' . $solicitud->folio . '</b>';
        $familia_options = Familia::orderBy('familia')->pluck('familia','id')->toArray();
        $estudio_options = Estudio::orderBy('estudio')->pluck('estudio','id')->toArray();

        // Si quieres mostrar como HTML normal:
        return view('app.solicitudes.viewmail', compact(
            'familia', 'title', 'familia_options', 'estudio_options',
            'solicitud', 'resultado', 'observacion'
        ));
    }

    public function send(Request $request)
    {
        $id = $request->input('id');
        $solicitud = Solicitud::findOrFail($id);
        $familia = Familia::find($solicitud->familia_id);

        $resultado = Resultado::where('solicitud_id', $id)
            ->where('resultado', '!=', '')
            ->orderBy('estudio', 'asc')
            ->orderByRaw('
                CASE titulo
                    WHEN "Serie Roja" THEN 1
                    WHEN "Serie Blanca" THEN 2
                    WHEN "Serie Plaquetaria" THEN 3
                    WHEN "Mielocitos" THEN 4
                END
            ')
            ->orderByRaw('
                CASE nombre
                    WHEN "Hematócrito" THEN 1
                    WHEN "Hemoglobina" THEN 2
                    WHEN "Eritrocitos" THEN 3
                    WHEN "Volumen globular medio (VGM)" THEN 4
                    WHEN "Volumen globular medio (VCM)" THEN 4
                    WHEN "Hemoglobina globular medio (HGM)" THEN 5
                    WHEN "Concentración media de hemoglobina globular (CMHC)" THEN 6
                    WHEN "Concentración media de hemoglobina globular" THEN 6
                    WHEN "Reticulocitos" THEN 7
                    WHEN "Leucocitos totales" THEN 8
                    WHEN "Leucocitos" THEN 8
                    WHEN "Neutrófilos segmentados" THEN 9
                    WHEN "Bandas" THEN 10
                    WHEN "Monocitos" THEN 11
                    WHEN "Linfocitos" THEN 12
                    WHEN "Eosinófilos" THEN 13
                    WHEN "Basófilos" THEN 14
                    WHEN "Mielocitos" THEN 15
                END
            ')
            ->orderBy('id', 'asc')
            ->get();

        $observacion = Observacion::where('solicitud_id', $id)->first();
        $title = "Resultados Análisis Clínicos Folio: <b>{$solicitud->folio}</b>";
        $familia_options = Familia::orderBy('familia')->pluck('familia','id')->toArray();
        $estudio_options = Estudio::orderBy('estudio')->pluck('estudio','id')->toArray();

        // Renderiza el HTML para el PDF
        $html = View::make('app.solicitudes.mail', compact(
            'familia','title','familia_options','estudio_options',
            'solicitud','resultado','observacion'
        ))->render();

        // Crea carpeta si no existe
        $pdfFolder = public_path('uploads/estudios');
        if (!is_dir($pdfFolder)) {
            mkdir($pdfFolder, 0755, true);
        }

        // Genera PDF y lo guarda
        $outputName = Str::random(10);
        $pdfPath = $pdfFolder.'/'.$outputName.'.pdf';
        $pdf = Pdf::loadHTML($html);
        $pdf->save($pdfPath);

        // Prepara datos de correo
        $data = [
            'nombre'  => $solicitud->mvz,
            'clinica' => $solicitud->clinica,
            'mascota' => $solicitud->id_animal
        ];

        // Envía el correo con el PDF adjunto
        Mail::send('emails.pdf', $data, function($message) use ($pdfPath, $solicitud) {
            $message->from('analisis@analisistuamigo.com', 'Tu Amigo Laboratorio Clínico');
            $message->subject('Resultados de <<'.$solicitud->id_animal.'>>, "TU AMIGO LABORATORIO CLÍNICO"');
            $message->to($solicitud->email);
            $message->cc('mazaclaudia82@gmail.com');
            $message->cc('labvet@analisistuamigo.com');
            $message->attach($pdfPath, ['as'=>'Resultados.pdf']);
        });

        // Opcional: borrar el PDF después de enviar
        // File::delete($pdfPath);

        return redirect()->route('app.solicitudes.index')->with('success', 'Se ha enviado el Resultado con éxito.');
    }


}
