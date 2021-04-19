@extends('layouts.plantilla')
@section('title', 'Perfil')


@section('content')
	<div class="container-fluid">
		 
		<h5 class="mt-4 mb-2">Datos personales</h5>

		@if ( session('mensaje') )
	        <div class="alert alert-success alert-dismissible fade show mt-2 w-75" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
	        </div>
	    @endif

	     @if ( session('error') )
	        <div class="alert alert-danger alert-dismissible fade show mt-2 w-75" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
	        </div>
	    @endif

		<form action="{{route('updateUser', $perfil[0]->id) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="card p-3 shadow w-75">
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Nombre:</label>
						<input type="text" name="name" id="name" class="form-control" required="" value="{{$perfil[0]->name ?? ''}}">
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="name">Correo electrónico:</label>
						<input type="email" name="email" id="email" class="form-control" required="" value="{{$perfil[0]->email ?? ''}}" disabled="">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Primer apellido:</label>
						<input type="text" name="paterno" id="paterno" class="form-control" required="" value="{{$perfil[0]->apellido_pat ?? ''}}">
					</div>
				</div>

				<div class="col-6">
					

				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Segundo apellido:</label>
						<input type="text" name="materno" id="materno" class="form-control" required="" value="{{$perfil[0]->apellido_mat ?? ''}}">
					</div>
				</div>
				<div class="col-6">
				</div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary border-button" data-toggle="modal" data-target="#updateDataUser">Actualizar</button>
			</div>
		</div>
		</form>

		<div class="card p-3 shadow mt-3 w-75">
			<p class="mt-4 text-muted">Usted creo su cuenta con nosotros hace: {{$perfil[0]->created_at->diffForHumans()}}</p>
			<p><b>Nota:</b> Para cambiar su contraseña por una nueva, deberá de dirigirse al aparatado de <strong class="text-success">Restablecer contraseña</strong> al inicio de la plataforma.</p>
		</div>
    	
	</div>


	<div class="modal fade" id="updateDataUser" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document" >
          <div class="modal-content" style="background: rgba(0,0,0,0.0); border: none;">
              <div class="modal-body d-flex justify-content-center align-items-center" style="height: 600px;">
                  <div class="spinner-border text-white"  style="width: 5rem; height: 5rem;" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
              </div>
          </div>
      </div>
    </div>
    
@endsection

@section('scriptjs')
    <script>

        
    </script>

@endsection