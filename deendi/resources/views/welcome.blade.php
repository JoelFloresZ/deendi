<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- estilos css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
     <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">

    <style>
      @font-face {
      font-family: 'deendi';
        src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
      }

      .deendi{
        font-family: deendi;
      }

      body {
        background-image: url("{{ asset('img/index.jpg')}}");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: all;
        /*animation: plane 10s alternate-reverse ease-in infinite;*/
      }

      @keyframes  plane {
          50% {
              background-position: bottom;
          }

          50% {
              background-position: top;
          }

      }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body class="text-center">
    <div id="contenedor-fondo">
      <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
          <div class="inner">
            <h3 class="masthead-brand deendi">{{ config('app.name', 'Laravel') }}</h3>
              <nav class="nav nav-masthead justify-content-center">
                  @if (Route::has('login'))
                      @auth
                          <a class="nav-link" href="{{ url('/inicio') }}">{{ __('Home') }}</a>
                      @else
                          <a class="nav-link" href="{{ url('/ayuda') }}" target="_blank">{{ __('Gu??a') }}</a>
                          <a class="nav-link" href="{{ route('login') }}">{{__('Login')}}</a>

                          @if (Route::has('register'))
                              <a class="nav-link" href="{{ route('register') }}">{{__('Register')}}</a>
                          @endif
                      @endauth
                  @endif
              </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
          <img src="{{asset('img/logo.png')}}" class="img-fluid" width="150px">
          <h1 class="cover-heading display-4 font-weight-bold deendi">{{ config('app.name', 'Laravel') }}</h1>
          <h3>Desarrollo de encuestas din??micas</h3>
          <p class="">
            DEENDI es una plataforma que permite el desarrollo de encuestas din??micas, con la ayuda de esta herramienta podr?? optimizar el tiempo de dise??o, implementaci??n y el an??lisis de sus datos que obtenga de su encuesta. La plataforma cuenta con 8 tipos de formularios para el dise??o de su encuesta adapt??ndose de acuerdo a sus necesidades para el levantamiento de los datos, adem??s cuenta con la opci??n de analizar los datos de forma general como un resumen de todos los datos obtenidos y m??s funciones para un mejor trabajo.
          </p>

        </main>

        <footer class="mastfoot mt-auto">
          <div class="inner">
            <p>{{ config('app.name', 'Laravel') }},<br>
              <span>&copy; 2020 Todos los derechos reservados</span><br>
              <small>Desarrollado por Joel Flores & Israel Lara</small>
            </p>
          </div>
        </footer>
      </div>
    </div>
</body>
</html>

