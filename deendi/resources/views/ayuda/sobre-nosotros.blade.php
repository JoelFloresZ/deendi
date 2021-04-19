@extends('layouts.plantilla')
@section('title', 'sobre-nosotros')
{{-- Formulario de busqueda --}}


@section('content')
	<div class="container-fluid">
		<div class="mt-3">
			<h5 class="font-weight-normal">Información de Deendi.</h5>

			<div class="card shadow w-75 mt-4">
				<div class="card-header bg-white border-bottom-0">
					<h5 class="card-title">DEENDI</h5><hr>
				</div>
				<div class="card-body">
					<p class="font-weight-normal">La plataforma deendi permite crear encuestas de forma dinámica, lo cual al implementar este tipo de encuesta ayuda a obtener mejores resultados, Optimiza los tiempos en desarrollar una encuesta, Analizar los datos obtenidos y además le ofrecemos al usuario una forma más interactiva en responda un formulario, asimismo cuenta con su propia administración de encuestas e usuarios con quienes trabajar para aplicar una encuesta.</p>
					<p class="font-weight-normal">De las cuales para el diseño de su encuesta cuenta con los siguientes formularios. </p>

					<ul class="navbar-nav">
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con respuestas abiertas.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con respuestas de opción simple.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con respuestas de opción múltiple.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con respuestas de opción desplegable.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas de valoración tipo escala numérica.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con respuestas de archivos.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Preguntas con Tablas dinámicas.
						</li>
						<li class="nav-item font-weight-normal">
							<span class="text-success h5 mr-1">*</span>Notas.
						</li>
					</ul>
				</div>
				
			</div>


			<div class="card shadow w-75 mt-5 mb-5">
				<div class="card-body text-muted">
					<span>Deendi (Desarrollo de encuestas dinámicas)</span>
					<p>Copyright 2020. Todos los derechos reservados.</p>
					<p>
						Deendi es una plataforma que ofrece como servicio el desarrollo de encuestas dinámicas la cual se implementa dentro de la plataforma como fuera para obtener resultados y mostrar resultados estadísticos como resultados por encuesta aplicado.
					</p>
					<p>
						<a href="#" class="text-decoration-none">Condiciones de servicio.</a>
					</p>
				</div>
				
			</div>

		</div>
	</div>
    
@endsection
