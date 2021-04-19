<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Reporte</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">     

        @font-face {
            font-family: 'deendi';
            src:url("{{ asset('webfonts/Roboto/Quicksand-Bold.ttf')}}");
        }

      .deendi{
        font-family: deendi;
      }
     
    </style>
</head>
<body class="bg-white">
    <div id="app">
           <input type="hidden" name="id_encuesta" id="id_encuesta" value="{{$id}}">
           <reporte></reporte>  
    </div>

   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('js/jsPDF-1.3.2/dist/jspdf.min.js')}}"></script>
    <script src="{{asset('js/jsPDF-1.3.2/dist/jspdf.debug.js')}}"></script>  
</body>
</html>
