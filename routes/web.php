<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudiosController;
use App\Http\Controllers\FamiliasController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\DashboardController;

// Ruta principal de bienvenida (pública)
Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas por Jetstream (requiere login y verificación de email)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard de Jetstream
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Agrupación de rutas bajo /app
    Route::prefix('app')->as('app.')->group(function () {
        // Estudios
        Route::get('estudios/data', [EstudiosController::class, 'data']);
        Route::resource('estudios', EstudiosController::class);

        // Familias
        Route::get('familias/data', [FamiliasController::class, 'data']);
        Route::resource('familias', FamiliasController::class);

        // Unidades
        Route::get('unidades/data', [UnidadesController::class, 'data']);
        Route::get('unidades/prueba', [UnidadesController::class, 'prueba']);
        Route::get('unidades/pruebadata', [UnidadesController::class, 'pruebadata']);
        Route::resource('unidades', UnidadesController::class);

        // Solicitudes
        Route::get('solicitudes/data', [SolicitudesController::class, 'data']);
        Route::post('solicitudes/send', [SolicitudesController::class, 'send']);
        Route::get('solicitudes/{solicitud}/mail', [SolicitudesController::class, 'viewMail']);
        Route::resource('solicitudes', SolicitudesController::class);
    });

    // Formulario (fuera de /app, pero protegido también)
    Route::resource('formulario', FormularioController::class);

    // Página de ejemplo protegida (puedes moverla fuera del middleware si quieres que sea pública)
    Route::get('sol', function () {
        return view('emails.solicitud');
    });

    Route::get('app/solicitudes/{solicitud}/mail', [App\Http\Controllers\SolicitudesController::class, 'viewMail'])
        ->name('app.solicitudes.viewMail');
});

Route::get('/ajax/familias/by-estudio', function (\Illuminate\Http\Request $request) {
    $familias = [];
    if ($request->filled('estudio_id')) {
        $familias = \App\Models\Familia::where('estudio_id', $request->estudio_id)
            ->orderBy('familia')
            ->pluck('familia', 'id');
    } else {
        $familias = \App\Models\Familia::orderBy('familia')->pluck('familia', 'id');
    }
    return response()->json($familias);
})->name('ajax.familias.byEstudio');
