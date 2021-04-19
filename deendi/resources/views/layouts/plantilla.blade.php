<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/offcanvas.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <style type="text/css">
      @font-face {
      font-family: 'Roboto';
        src:url("{{ asset('webfonts/Roboto/Roboto-Regular.ttf')}}");
      }

      @font-face {
      font-family: 'deendi';
        src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
      }

      .deendi{
        font-family: deendi;
      }
      body{
      font-family: Roboto;
      }

      .bg-navbar {
        background:#3a5184;
      }
    </style>

   @yield('estilos')

  </head>
  <body>
    {{-- Navbar --}}
    <div id="app">
        <nav class="navbar navbar-dark sticky-top bg-navbar flex-md-nowrap p-0 shadow">
            <span class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 deendi" href="#">
              <img src="{{asset('img/logo.png')}}" class="img-fluid" width="35px">
              {{ config('app.name', 'Laravel') }}
            </span>
            <button class="navbar-toggler position-absolute d-md-none collapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            @yield('form-sarch')

            <ul class="navbar-nav px-3">
              @guest
                  <li class="nav-item text-nowrap">
                    <p>Invitado</p>
                  </li>
              @else
                <li class="nav-item dropdown ml-2">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="z-index: 1400; position: absolute;">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt mr-1 h5"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
          
              @endguest
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                  @component('components/sidebar')
                  @endcomponent
                </nav>

               <div class="container-fluid">
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                      {{-- Contenido de la aplicación --}}
                      @yield('content')
                    </main>
               </div>
            </div>
        </div>
    </div>
    







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/offcanvas.js')}}"></script>
    @yield('scriptjs')

  </body>
  </html>