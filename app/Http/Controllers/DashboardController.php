<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\Familia;
use App\Models\Unidad;
use App\Models\Solicitud;

class DashboardController extends Controller
{
    public function index()
    {
        // Ejemplo de estadísticas rápidas
        $totalEstudios = Estudio::count();
        $totalFamilias = Familia::count();
        $totalUnidades = Unidad::count();
        $totalSolicitudes = Solicitud::count();

        return view('dashboard', compact(
            'totalEstudios',
            'totalFamilias',
            'totalUnidades',
            'totalSolicitudes'
        ));
    }
}
