<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">
    

    <title>{{ config('app.name', 'Laravel') }} | Encuesta finalizado</title>

    <style type="text/css">
      #border-button {
        border-bottom: 3px solid #3490dc;
      }

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

      body {
        font-family: Roboto;
      } 

      .bg1 {
          background: tomato;
      }

      .bg2 {
          background: #5727dd;
          opacity: 0.8;

      }

      .bg3 {
          background: #32f1b1;
      }

      .bg-navbar {
        background:#3a5184;
      }
    </style>

  </head>
  <body class="bg-white">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary text-center">
        <a class="navbar-brand deendi" href="#">{{ config('app.name', 'Laravel') }}</a>        
    </nav>

    <div class="container m-auto w-75 d-flex justify-content-center align-items-center" style="height: 70vh; ">
        <div class="row">
            <div class="col-0 col-sm-0 col-md-2"></div>
            <div class="col-12 col-sm-12 col-md-8">
              <div class="text-center">
                  <h4 class="font-weight-bold mb-2">Gracias por su tiempo</h4>
                  <p class="pb-3 text-uppercase">Sus respuestas serán analizadas de forma confidencial y con fines Estadisticos</p>
                  
                  <span class="p-5 rounded-circle bg1 position-absolute"></span>
                  <span class="p-5 rounded-circle bg2 position-absolute ml-5 mt-5"></span>
                  <span class="p-5 rounded-circle bg3 position-absolute" style="left: 30%;"></span>
              </div>
            </div>
            <div class="col-0 col-sm-0 col-md-2"></div>
        </div>
    </div>

  </body>
  </html>