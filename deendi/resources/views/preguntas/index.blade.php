<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">
    

    <title>Deendi | Vista previa</title>

    <style type="text/css">
      #border-button {
        border-bottom: 3px solid #3490dc;
      }
      @font-face {
            font-family: 'deendi';
            src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
        }

      .deendi{
            font-family: deendi;
        }

      @font-face {
      font-family: 'Roboto';
        src:url("{{ asset('webfonts/Roboto/Roboto-Regular.ttf')}}");
      }

      body {
        font-family: deendi;
      } 

      .color_titulo {
      color: {{$estilos_encuesta[0]->color_titulo}};
      }

      .color_pregunta {
        color: #000;
      }

      .bg-fondo-img {
      position: absolute;  
      width: 100%;
      height: 200px;
      background-image: url("{{ $estilos_encuesta[0]->url_imagen }}");
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      background-clip: border-box;  
      opacity: 1; 
      box-shadow: 0px 2px 0px  #f2f2f2;
      filter: contrast(1px);  
      }

      .bg {
        position: relative;
        top: 100px;
      }

      

      @media (max-width: 1400px) {
        .container-fluid {
          width: 100%;
          max-width: 70%;
        }
      }

      @media (max-width: 800px) {
        .container-fluid {
          width: 100%;
          max-width: 80%;
        }

      }

      @media (max-width: 600px) {
        .container-fluid {
          width: 100%;
          max-width: 95%;
        }

      }

      @media (max-width: 450px) {
        .container-fluid {
          width: 100%;
          max-width: 100%;
        }

        .bg-fondo-img { 
          height: 250px;
        }
      }

    </style>

  </head>
  <body class="bg-light">
    {{-- Navbar --}}{{-- {{$estilos_encuesta}} --}}
  <div class="bg-fondo-img"></div>

    <div class="container-fluid m-auto bg" id="app">
      <div class="card p-3 shadow">
        <input type="hidden" name="encuesta_id" id="encuesta_id" value="{{$encuesta[0]['id']}}">
        <h2 class="font-weight-bold color_titulo">{{$encuesta[0]['titulo']}}</h2>
        <p class="font-weight-normal">{{$encuesta[0]['descripcion']}}</p>
        <hr class="color_titulo w-75">
        <encuestavista></encuestavista>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/app.js')}}"></script>
  </body>
  </html>