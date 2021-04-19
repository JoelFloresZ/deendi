@extends('layouts.plantilla')
@section('title', 'Datos por encuesta')
{{-- Formulario de busqueda --}}


@section('content')
	<div class="container-fluid p-2">
		<div class="row">
			<div class="col-10">
				<h5 class="text-muted font-weight-bold mt-2">Análisis  de los datos obtenidos | Resumen</h5>
				<input type="hidden" name="id_encuesta" id="id_encuesta" value="{{$id}}">
				<hr>
				
				<analisisresumen></analisisresumen>
				
			</div>
			<div class="col-2">
				<h5 class="text-muted font-weight-bold mt-2">Ver resultados</h5>
				<hr>
				<div class="mt-2">
					<nav class="card p-3 mt-3">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a href="{{route('verResultadoResume',encrypt($id))}}" class="nav-link active">Resumen</a>
							</li>
							<li class="nav-item">
								<a href="{{route('verResultado', encrypt($id))}}" class="nav-link">General</a>
							</li>
							<li class="nav-item">
								<a href="{{route('pdf', encrypt($id))}}" class="nav-link" target="_blank">PDF</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
    
@endsection

@section('scriptjs')
    <!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	{{-- <script src="{{ asset('js/lightbox-plus-jquery.min.js')}}"></script> --}}
       
@endsection