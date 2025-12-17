<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts y estilos de Jetstream -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Mensajes SweetAlert -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    @if(session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: "{{ session('warning') }}",
                    confirmButtonColor: '#f6c23e',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#e3342f',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @livewireScripts
    @stack('modals')
    @stack('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'info',
            title: 'Prueba SweetAlert2',
            text: 'Si ves esto, todo está bien.',
        });
    });
</script>
</body>
</html>
