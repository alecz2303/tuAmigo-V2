<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\Estudio;
use App\Models\Familia;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function index(Request $request)
    {
        $estudios = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        $familias = Familia::orderBy('familia')->pluck('familia', 'id');

        // Control de registros por página
        $perPage = $request->input('per_page', 10); // Default 20
        if ($perPage === "all") {
            $perPage = 1000000;
        } else {
            $perPage = (int)$perPage;
        }

        $query = Unidad::with(['estudio', 'familia'])
            ->join('estudios', 'unidades.estudio_id', '=', 'estudios.id')
            ->join('familias', 'unidades.familia_id', '=', 'familias.id')
            ->select('unidades.*');

        // Filtros
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('unidades.titulo', 'like', "%$search%")
                  ->orWhere('unidades.nombre', 'like', "%$search%")
                  ->orWhere('unidades.valor', 'like', "%$search%")
                  ->orWhere('unidades.unidad', 'like', "%$search%")
                  ->orWhere('estudios.estudio', 'like', "%$search%")
                  ->orWhere('familias.familia', 'like', "%$search%");
            });
        }
        if ($request->filled('estudio_id')) {
            $query->where('unidades.estudio_id', $request->estudio_id);
        }
        if ($request->filled('familia_id')) {
            $query->where('unidades.familia_id', $request->familia_id);
        }
        if ($request->filled('titulo')) {
            $query->where('unidades.titulo', 'like', "%{$request->titulo}%");
        }

        // Orden personalizado
        $unidades = $query
            ->orderBy('estudios.estudio')
            ->orderBy('familias.familia')
            ->orderBy('unidades.titulo')
            ->orderBy('unidades.created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('app.unidades.index', compact('unidades', 'estudios', 'familias', 'perPage'));
    }

    public function create()
    {
        $title = "Agregar Valor";
        $estudios = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        $familias = Familia::orderBy('familia')->pluck('familia', 'id');
        return view('app.unidades.create_edit', compact('title', 'estudios', 'familias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estudio_id' => 'required|integer|exists:estudios,id',
            'familia_id' => 'required|integer|exists:familias,id',
            'titulo'     => 'required|string|max:255',
            'nombre'     => 'required|string|max:255',
            'valor'      => 'required|string|max:255',
            'unidad'     => 'nullable|string|max:255',
        ]);

        Unidad::create($validated);

        return redirect()->route('app.unidades.index')
            ->with('success', 'El valor se ha agregado correctamente.');
    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        $title = "Editar Valor";
        $estudios = Estudio::orderBy('estudio')->pluck('estudio', 'id');
        $familias = Familia::orderBy('familia')->pluck('familia', 'id');
        return view('app.unidades.create_edit', compact('unidad', 'title', 'estudios', 'familias'));
    }

    public function update(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);

        $validated = $request->validate([
            'estudio_id' => 'required|integer|exists:estudios,id',
            'familia_id' => 'required|integer|exists:familias,id',
            'titulo'     => 'required|string|max:255',
            'nombre'     => 'required|string|max:255',
            'valor'      => 'required|string|max:255',
            'unidad'     => 'nullable|string|max:255',
        ]);

        $unidad->update($validated);

        return redirect()->route('app.unidades.index')
            ->with('success', 'El valor se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
        Unidad::destroy($id);
        return redirect()->route('app.unidades.index')
            ->with('warning', 'El valor se ha eliminado.');
    }
}
