<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
        ..:: Tu Amigo ::..
        @show
    </title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/foundation.min.css')}}">
    <script src="{{asset('js/vendor/modernizr.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/foundation/dataTables.foundation.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.tablesTools.css')}}">
    <link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('js/pivot/pivot.css') }}">

</head>

<body>
    <!-- Menu -->
        <nav class="top-bar no-print" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                    <h1><a href="#">Tu Amigo Laboratorio Clínico</a></h1>
                </li>
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <section class="top-bar-section">
                <!-- Right Nav Section -->
                @if (Auth::check())
                <ul class="right">
                  <li {{ (Request::is('app/solicitudes') ? ' class="active"' : '') }}><a href="{{ URL::to('app/solicitudes') }}">Solicitud de Estudios</a></li>
                  <li class="divider"></li>
                  <li class="has-dropdown">
                    <a href="#">Configuración</a>
                    <ul class="dropdown">
                      <li {{ (Request::is('app/estudios') ? ' class="active"' : '') }}>
                        <a href="{{ URL::to('app/estudios') }}">Estudios</a>
                      </li>
                      <li {{ Request::is('app/familias') ? ' class="active"' : '' }}>
                        <a href="{{ URL::to('app/familias') }}">Especies</a>
                      </li>
                      <li {{ Request::is('app/unidades') ? ' class="active"' : '' }}>
                        <a href="{{ URL::to('app/unidades') }}">Valores</a>
                      </li>
                    </ul>
                  </li>
                </ul>
                @endif
                <!-- Left Nav Section -->
                <ul class="left">
                    @if (Auth::check())
                    <li>
                        <a href="{{{ URL::to('users/logout') }}}">Salir</a>
                    </li>
                    <li class="divider"></li>
                    <li {{ (Request::is('/') ? ' class="active"' : '') }}>
                        <a href="{{ URL::to('/') }}">Inicio</a>
                    </li>
                    @else
                    <li>
                        <a class="button left success tiny" href="{{{ URL::to('users/login') }}}">Entrar</a></li>
                    </li>
                    @endif
                </ul>
            </section>
        </nav>
    <!-- Menu -->
    <!-- Container -->
        <div class="wrap">
            <div class="container">
                <!-- Notifications -->
                @include('notifications')
                <!-- ./ notifications -->
                <!-- Content -->
                <div class="contenido">
                    @yield('content')
                </div>
                <!-- ./ content -->
            </div>
        </div>
    <!-- ./ container -->
    
    <!-- Scripts -->
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{asset('js/foundation.min.js')}}"></script>
        <script src="{{asset('js/jquery.colorbox.js')}}"></script>
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
        <script src="{{asset('js/dataTables.tableTools.js')}}"></script>
        <script src="{{asset('js/jquery-ui.min.js')}}"></script>

        

        <script type="text/javascript">
            $.fn.dataTable.TableTools.defaults.aButtons = [
                {
                    "sExtends": "copy",
                    "sButtonText": "Copiar al portapapeles"
                },
                {
                    "sExtends": "print",
                    "sButtonText": "Imprimir"
                },
                {
                    "sExtends":    "collection",
                    "sButtonText": "Guardar",
                    "aButtons":    [ "csv", "xls", "pdf" ]
                }
            ];
            $.extend( $.fn.DataTable.defaults, {
                responsive:true,
                displayLength: 5,
                "pageLength": 5000,
                lengthMenu: [[-1, 5, 10, 25, 50, 100], ["Todos", 5, 10, 25, 50, 100]],
                language: {
                    "sLengthMenu": "Mostrar _MENU_ ",
                    "sInfo": "Mostrando _START_ al _END_ de _TOTAL_ registros",
                    "sSearch": "Buscar:",
                    "paginate": {
                        "first":      "Primera",
                        "last":       "Última",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
                },
                "bProcessing": true,
                "bServerSide": false,
                "fnDrawCallback": function ( oSettings ) {
                    $(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
                    $(".iframe1").colorbox({iframe:true, width:"50%", height:"70%"});
                    $(".iframe2").colorbox({iframe:true, width:"100%", height:"100%"});
                },
                dom: 'T<"wrapper"flit>p',
            });
        </script>
        <script>
            $(document).foundation();
        </script>
        @yield('scripts')
    <!-- Scripts -->
</body>

</html>
