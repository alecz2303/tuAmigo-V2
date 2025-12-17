<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenido | Tu Amigo Laboratorio Clínico</title>
    <link rel="icon" href="{{ asset('images/logota.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            /* Fondo animado */
            background: linear-gradient(-45deg, #f7fafc, #60a5fa, #c0e2fc, #f7fafc);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-2xl p-10 max-w-lg w-full text-center bg-opacity-90">
        <img src="{{ asset('images/logota.png') }}" alt="Logo Tu Amigo" class="mx-auto mb-6 w-32 h-auto">
        <h1 class="text-3xl font-bold mb-2 text-blue-900">Bienvenido a <span class="text-blue-700">Tu Amigo Laboratorio Clínico</span></h1>
        <p class="text-gray-600 mb-6">Sistema de gestión y consulta de estudios clínicos veterinarios.</p>
        
        @if (Route::has('login'))
            <div class="mb-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-bold shadow transition">
                        Ir al Panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-bold shadow transition">
                        Iniciar Sesión
                    </a>
                @endauth
            </div>
        @endif

        <hr class="my-6">

        <div class="text-xs text-gray-400">Desarrollado por <span class="font-semibold text-blue-500">Alejandro Fedle Rueda Jimenez</span> &copy; {{ date('Y') }}</div>
    </div>
</body>
</html>
