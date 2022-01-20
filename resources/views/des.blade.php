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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/nuevo.css') }}" rel="stylesheet">
</head>
<body >
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Homepage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Route::has('login'))

                                @auth
                                    <a href="{{ url('/home') }}">{{ Auth::user()->name }}</a>
                                @else
                                <a href={{ route('login')}} class="btn btn-primary" role="button" aria-pressed="true">{{ __('Acceder') }}</a>

                                      @if (Route::has('register'))
                                    @endif
                                @endauth

                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div class="container" >
     @include('flash-message')
        <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" ><h1 style="text-align: center;">{{ __('Management and Sales System SPBV ') }}</h1></div>

                    <div class="card-body" style="background-image: url('./image/frutal.png'); background-position:center; background-repeat: no-repeat; position: relative; background-color: #E8C6E9;">
                        <p style="text-align: center;"><strong>Welcome to  system of administration of your local business</strong></p>
                        <div class="container">
                        </br>
                          </br>
                            </br>
                              </br>
                                </br>
                                  </br>
                                    </br>
                                    </br>
                                    <p align="center">
                                    <button  align="center" type="button" class="btn btn-info btn-sm btnDownload" data-toggle="tooltip" title="Nuevo">
 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
</svg>&nbsp;&nbsp;<strong> Descarga la app oficial </strong></button></p>

                        </div>
                            </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Descarga de app -- Disponible en android</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Presione "Descargar" para confirmar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="/app_sistema_ventas.apk" id="descargacomplete">Descargar</a>
        </div>
      </div>
    </div>
  </div>
    </div>

</br>
</br>
</br>
    <footer class="container-fluid text-center" style="background-color: #E8C6E9; border-radius: 14px 14px 14px 14px;-moz-border-radius: 14px 14px 14px 14px;-webkit-border-radius: 14px 14px 14px 14px;border: 0px solid #000000;">
              <div >
        <p style="color: black">Av. Central Manzana 3 32 Oaxaca(68200), Villa De Etla - Tels: 9514977069 </br>Copyright &copy; <a style="color: black">Sheila Paola Bohorges Vargas</a> <?php $anio= date("Y"); echo $anio?>. Todos los derechos reservados.</p>
    </div>
        </footer>
          <script src="{{ asset('js/otro.js') }}" defer></script>
</body>
</html>
