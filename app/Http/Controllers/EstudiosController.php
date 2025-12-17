<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class EstudiosController extends Controller
{
    // El middleware no es necesario aquí si ya tienes las rutas protegidas en web.php

    /**
     * Estadísticas para Datatables (AJAX).
     */
    public function data()
    {
        $estudio = DB::table('estudios')
            ->select('id', 'estudio', 'comentario');

        return DataTables::of($estudio)
            ->addColumn('actions', function ($row) {
                // Puedes construir el HTML aquí o desde Blade
                $editUrl = route('app.estudios.edit', $row->id);
                $deleteForm = '<form method="POST" action="' . route('app.estudios.destroy', $row->id) . '" style="display:inline;">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Seguro?\')">'
                    . '<i class="fa fa-trash"></i></button></form>';

                return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ' . $deleteForm;
            })
            ->rawColumns(['actions'])
            ->removeColumn('id')
            ->make(true);
    }

    /**
     * Mostrar todos los estudios.
     */
    public function index()
    {
        $estudios = \App\Models\Estudio::orderBy('created_at', 'desc')->paginate(10);
    	return view('app.estudios.index', compact('estudios'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $title = "Agregar Estudio";
        return view('app.estudios.create_edit', compact('title'));
    }

    /**
     * Guardar nuevo estudio.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
			'estudio' => 'required|string|max:255',
			'comentario' => 'nullable|string|max:500',
		]);

        $validated['comentario'] = $validated['comentario'] ?? '';
	
		$estudio = Estudio::create($validated);
	
		return redirect()->route('app.estudios.index')
			->with('success', 'El nuevo estudio se ha agregado correctamente.');
    }

    /**
     * Mostrar un estudio específico (puedes ajustar si necesitas vista o JSON).
     */
    public function show($id)
    {
        $estudio = Estudio::findOrFail($id);
        return view('app.estudios.show', compact('estudio'));
        // o: return response()->json($estudio);
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $estudio = Estudio::findOrFail($id);
        $title = "Editar Estudio";
        return view('app.estudios.create_edit', compact('estudio', 'title'));
    }

    /**
     * Actualizar un estudio.
     */
    public function update(Request $request, $id)
    {
        $estudio = Estudio::findOrFail($id);

		$validated = $request->validate([
			'estudio' => 'required|string|max:255',
			'comentario' => 'nullable|string|max:500',
		]);

		$estudio->update($validated);

		return redirect()->route('app.estudios.index')
			->with('success', 'El estudio se ha actualizado correctamente.');
    }

    /**
     * Eliminar un estudio.
     */
    public function destroy($id)
    {
        Estudio::destroy($id);
        return Redirect::route('app.estudios.index')->with('warning', 'Se ha eliminado el estudio.');
    }
}
