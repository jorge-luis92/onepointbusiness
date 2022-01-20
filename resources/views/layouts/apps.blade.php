<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="{{ asset('fruta-logo.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fruits</title>

    <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/mijs.js') }}" defer></script>

  <link rel="stylesheet"  href="{{asset('css/nuevo.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"  href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    Homepage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                          <!--  <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>-->
                            @if (Route::has('register'))
                              <!--  <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>-->
                            @endif
                        @else
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item dropdown">
                            <a class="navbar-brand" href="{{ route('users') }}">
                                Usuarios
                            </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                  <a class="dropdown-item" href="{{ route('registrar_usuario') }}">Registrar Usuario</a>
                                  <a class="dropdown-item" href="usuarios_activos">Usuarios registrados</a>
                              <!--    <a class="dropdown-item" href="#">Disabled Users</a>-->
                                </div>
                              </li>
                              <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Productos
                                    </a>
                                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <!--    <a class="dropdown-item" href="frutas">Frutas y Verduras</a>
                                      <a class="dropdown-item" href="carnes">Carnes y Lacteos</a>
                                      <a class="dropdown-item" href="semillas">Semillas, Dulces y Otros</a>-->
                                      <a class="dropdown-item" href="products">Todos los productos</a>
                                      <a class="dropdown-item" href="registros_eventos">Registros de Eventos</a>
                                      <a class="dropdown-item" href="disabled">Desactivados</a>
                                    </div>
                                  </li>
                                  <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         Ventas
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                          <a class="dropdown-item" href="ventas">Nueva venta</a>
                                          <a class="dropdown-item" href="registros">Registros Generales</a>
                                          <a class="dropdown-item" href="registros_especificos">Registros Especificos</a>

                                        </div>
                                      </li>

                        </ul>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                  <!--  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Configuración de cuenta') }}
                                    </a>-->

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('cuenta') }}" >
                                        {{ __('Configuración de Contraseña') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
  </br>
  </br>
  </br>
  </br>
</br>


    <footer class="container-fluid text-center" style="background-color: #E8C6E9; border-radius: 14px 14px 14px 14px;-moz-border-radius: 14px 14px 14px 14px;-webkit-border-radius: 14px 14px 14px 14px;border: 0px solid #000000;">
              <div >
        <p style="color: black">Av. Central Manzana 3 32 Oaxaca(68200), Villa De Etla - Tels: 9513825715 </br>Copyright &copy; <a style="color: black">Sheila Paola Bohorges Vargas</a> <?php $anio= date("Y"); echo $anio?>. Todos los derechos reservados.</p>
    </div>
        </footer>

        <main class="py-4">
            @yield('scru')
            <script  src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"  defer ></script>

        </main>
</body>
</html>
