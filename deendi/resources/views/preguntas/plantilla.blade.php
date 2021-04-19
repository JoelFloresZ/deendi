@extends('layouts.plantilla')
@section('title', 'Diseño-de-la-encuesta')

@section('estilos')
	<style type="text/css">
		.color_titulo {
			color: {{ $estilos_encuesta[0]->color_titulo }};
		}

		.color_pregunta {
			color: #000;
		}

		.bg-fondo-img {
			position: relative;
			height: 250px;
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
	        top: -170px;
	     }
		
	</style>

@endsection

@section('content')
	<div class="container-fluid">
		<div class="mt-3" style="height: 50vh;">
		
			<div class="row p-0">
				<div class="col-lg-10 px-0 mx-0">
					
					<div class="bg-fondo-img"></div>

					<div class="card shadow mb-4 m-auto bg" id="card-encuesta" style="width: 800px;">
						@if ( session('error') )
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{{ session('error') }}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
						
						<div class="p-3">
							<div class="container-fluid d-flex justify-content-end">
								<i class="fa fa-edit h5 btn-light rounded-circle p-1 ml-1" style="cursor: pointer;" data-toggle="modal" data-target="#editar_encuesta"></i>

								<a href="{{route('mostrarEncuestaEnProceso', encrypt($datos_encuesta[0]['id']))}}" target="_blank">
									<i class="fa fa-eye h5 btn-light rounded-circle p-1" style="cursor: pointer;"></i>
								</a>
								<i class="fa fa-palette h5 btn-light rounded-circle p-1 ml-1" style="cursor: pointer;" data-toggle="modal" data-target="#diseño"></i>
								<i class="fa fa-image h5 btn-light rounded-circle p-1 ml-1" style="cursor: pointer;" data-toggle="modal" data-target="#diseño-archivo"></i>
							</div>

							<div>
								<h2 class="font-weight-bold color_titulo">{{$datos_encuesta[0]['titulo']}}</h2>
								<p class="font-weight-normal">{{$datos_encuesta[0]['descripcion']}}</p>
								<hr class="bg-primary">
								<input type="hidden" name="id_encuesta" id="id_encuesta" value="{{$datos_encuesta[0]['id']}}">
							</div>
						</div>
												
						<diselo-encuesta class="p-3"></diselo-encuesta>

						{{-- Opciones para guardar encuesta --}}
						<div class="d-flex justify-content-end mt-3 mb-3 p-3">
							<a class="btn btn-outline-secondary border-button" href="{{ route('pendienteEncuesta',$datos_encuesta[0]['id'])}}">GUARDAR</a>
							<a class="btn btn-outline-primary border-button ml-2" href="{{ route('finalizarEncuesta', $datos_encuesta[0]['id'])}}">FINALIZAR</a>
						</div>
												
					</div>
				</div>
				<div class="col-lg-2 px-0 mx-0">
					<sidebar-dising></sidebar-dising>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="diseño" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <form method="post" action="{{route('agregarEstilosFuente')}}" enctype="multipart/form-data">
	    	@csrf

	    <div class="modal-content">
	      <div class="modal-header bg-white">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Diseño</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="id_encuesta" id="id_encuesta" value="{{$datos_encuesta[0]['id']}}">

			<div class="form-group">
				<label>Color de titulo de la encuesta</label><br>
				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="azul_titulo" name="color_titulo" class="custom-control-input" value="#3498DB">
				  <label class="custom-control-label" for="azul_titulo" style="color:#3498DB;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="verde_t" name="color_titulo" class="custom-control-input"  value="#27AE60">
				  <label class="custom-control-label" for="verde_t" style="color:#27AE60;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="rojo_t" name="color_titulo" class="custom-control-input"  value="#E74C3C">
				  <label class="custom-control-label text-danger" for="rojo_t"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="naranja_t" name="color_titulo" class="custom-control-input"  value="#E67E22">
				  <label class="custom-control-label" for="naranja_t" style="color: #E67E22;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="morado_t" name="color_titulo" class="custom-control-input"  value="#8E44AD">
				  <label class="custom-control-label" for="morado_t" style="color:#8E44AD;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="negro_t" name="color_titulo" class="custom-control-input"  value="#000000">
				  <label class="custom-control-label" for="negro_t" style="color:#000000;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="blanco_t" name="color_titulo" class="custom-control-input"  value="#ffffff">
				  <label class="custom-control-label" for="blanco_t" style="color:#f2f2f2;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="1" name="color_titulo" class="custom-control-input"  value="#3949AB">
				  <label class="custom-control-label" for="1" style="color:#3949AB ;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="2" name="color_titulo" class="custom-control-input"  value="#F1C40F">
				  <label class="custom-control-label" for="2" style="color:#F1C40F;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="3" name="color_titulo" class="custom-control-input"  value="#FF0033">
				  <label class="custom-control-label" for="3" style="color:#FF0033;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="4" name="color_titulo" class="custom-control-input"  value="#FF0066">
				  <label class="custom-control-label" for="4" style="color:#FF0066;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="5" name="color_titulo" class="custom-control-input"  value="#33CC00 ">
				  <label class="custom-control-label" for="5" style="color:#33CC00;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="6" name="color_titulo" class="custom-control-input"  value="#2E4053">
				  <label class="custom-control-label" for="6" style="color:#2E4053;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>

				<div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="7" name="color_titulo" class="custom-control-input"  value="#33CCFF">
				  <label class="custom-control-label" for="7" style="color:#33CCFF;"><i class="fa fa-cube mt-1 h5"></i></label>
				</div>
			</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary btn-sm border-button" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary btn-sm border-button">Guardar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>

	<!-- Modal para fondo archivo -->
	<div class="modal fade" id="diseño-archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <form method="post" action="{{route('agregarEstilos')}}" enctype="multipart/form-data">
	    	@csrf

	    <div class="modal-content">
	      <div class="modal-header bg-white">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Añadir un imagen de fondo</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<input type="hidden" name="id_encuesta" id="id_encuesta" value="{{$datos_encuesta[0]['id']}}">

	        <div class="form-group">
			    <label for="exampleFormControlFile1">Seleccionar un imagen</label>
			    <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
			</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary btn-sm border-button" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary btn-sm border-button">Guardar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>

	<!-- Modal para editar encuesta -->
	<div class="modal fade" id="editar_encuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <form method="post" action="{{route('editarDatosEncuesta', $datos_encuesta[0]['id'])}}">
	    	@csrf

	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalCenterTitle">Actualizar datos</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      				
			 @csrf
		        <div class="form-group">
		          <label>Titulo de la encuesta</label>
		          <textarea name="titulo" id="titulo" placeholder="Titulo" class="@error('titulo') is-invalid @enderror form-control" autofocus="" rows="1" value="{{old('titulo')}}">{{$datos_encuesta[0]['titulo']}}</textarea>
		           @error('titulo')
		                <span class="text-danger">{{ $message }}</span>
		            @enderror   
		        </div>

		        <div class="form-group">
		          <label>Descripción / Instructivos</label>
		          <textarea name="descripcion" id="descripcion" class="@error('descripcion') is-invalid @enderror form-control" placeholder="Descripción" value="{{old('descripcion')}}" rows="6">{{$datos_encuesta[0]['descripcion']}}</textarea>
		          @error('descripcion')
		                <span class="text-danger">{{ $message }}</span>
		          @enderror
		        </div>
	        

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary btn-sm border-button" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary btn-sm border-button">Actualizar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>

	
    
@endsection


@section('scriptjs')
	<script type="text/javascript">
		var cardEncuesta = document.getElementById('card-encuesta');
		cardEncuesta.scrollTop = cardEncuesta.scrollHeigth;
	</script>
@endsection