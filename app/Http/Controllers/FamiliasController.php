<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliasController extends Controller
{
    public function index(Request $request)
    {
        $query = Familia::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('familia', 'like', "%$search%");
        }

        $familias = $query->orderBy('familia', 'asc')->paginate(10)->withQueryString();

        return view('app.familias.index', compact('familias'));
    }

    public function create()
    {
        $title = "Agregar Especie";
        return view('app.familias.create_edit', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'familia' => 'required|string|max:255',
        ]);

        Familia::create($validated);

        return redirect()->route('app.familias.index')
            ->with('success', 'La especie se ha agregado correctamente.');
    }

    public function edit($id)
    {
        $familia = Familia::findOrFail($id);
        $title = "Editar Especie";
        return view('app.familias.create_edit', compact('familia', 'title'));
    }

    public function update(Request $request, $id)
    {
        $familia = Familia::findOrFail($id);

        $validated = $request->validate([
            'familia' => 'required|string|max:255',
        ]);

        $familia->update($validated);

        return redirect()->route('app.familias.index')
            ->with('success', 'La especie se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
        Familia::destroy($id);
        return redirect()->route('app.familias.index')
            ->with('warning', 'La especie se ha eliminado.');
    }
}
