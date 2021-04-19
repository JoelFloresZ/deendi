@extends('layouts.plantilla')
@section('title', 'Agenda de grupos')
{{-- Formulario de busqueda --}}
@section('form-sarch')
    {{-- <x-formsearch metodo="GET" ruta="{{ route('buscarGrupo') }}"  buscar="Buscar grupo"></x-formsearch> --}}

    @component('components/formsearch', ['metodo' => 'GET', "buscar" => "Buscar grupo" ])
    {{ route('buscarGrupo') }}
    @endcomponent
@endsection

@section('content')
	<div class="container-fluid">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        	<h1 class="h3">{{$ver ?? 'Grupos de Trabajo'}}</h1>
	     	<div>
	     		
	     	</div>
    	</div>
		{{-- lista de encuestas --}}
		
    	<div>
    		@if (count($grupos) > 0)
			    <div>
			    	@if ( session('mensaje') )
				        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
			                {{ session('mensaje') }}
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			                </button>
				        </div>
				    @endif

				     @if ( session('error') )
				        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
			                {{ session('error') }}
			                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			                </button>
				        </div>
				    @endif

				    <div class="card">
				    	<table class="table">
						  <thead class="thead-inverse">
						    <tr>
						      <th scope="col">Nombre del grupo</th>
						      <th scope="col">Integrantes</th>
						      <th scope="col">
						      	<div class="float-right">
						      		<button type="button" class="btn btn-primary border-button" data-toggle="modal" data-target="#form-grupo">
							      		Nuevo grupo
							      	</button>
						      	</div>
						      </th>
						    </tr>
						  </thead>
						  <tbody>
						  	@foreach ($grupos as $grupo)
								<tr>
							      <td>{{$grupo->nombre}}</td>
							      <td>
							      	<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#listaDeIntegrantes" onclick="getListaGrupo({{$grupo->id}})">Ver lista</button>
							      </td>
							      <td>
							      	<div class="d-flex justify-content-end">
					      				<button type="button" class="btn btn-outline-light btn-sm text-dark" data-toggle="modal" data-target="#edit-form-grupo" onclick="getDatosGrupo({{$grupo->id}})"><i class="fa fa-edit h5"></i></button>
					      				
					      				<form method="post" action="{{route('eliminarGrupo', $grupo->id)}}">
					      					@csrf
					      					<button type="submit" class="btn btn-outline-light btn-sm text-dark" onclick="return eliminarGrupo()"><i class="fa fa-trash h5"></i></button>
					      				</form>
					      				
					      			</div>
							      </td>
							    </tr>
						  	@endforeach
						  </tbody>
						</table>
				    </div>
			    </div>
			@else
			    <div class="d-flex justify-content-center align-items-center w-100" style="height: 60vh;">

			    	@switch($ver ?? '')
                        @case('Resultado')
                            <div>
                                <h2 class="font-weight-bold text-center">No hubo resultados de la búsqueda del grupo</h2>
                                <div class="text-center">
                                    <p class="text-center"><i class="fa fa-angle-double-left"></i></p>
                                    <a href="{{ route('gruposDeTrabajo')}}">Regresar</a>
                                </div>
                			</div>
                            @break  

                        @default
                            <div class="text-center">
								<div>
									<img src="{{asset('img/img-view/grupos.svg')}}" class="img-fluid" width="300px">
									<h2 class="font-weight-bold text-center">No hay ningún grupo creado para mostrar</h2>
									<p class="text-center">Aquí se mostrarán todos los grupos creados por usted. </p>
									<div class="">
								    	<button type="button" class="btn btn-outline-secondary mr-5" data-toggle="modal" data-target="#form-grupo">
											<i class="fa fa-plus  display-4"></i>
										</button>
									</div>
								</div>
							</div>
                    @endswitch

			@endif
    	</div>	
	</div>


	<!-- Button trigger modal -->
	
	<!-- Modal Form Edit Contactos -->
	<div class="modal fade" id="edit-form-grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Actualizar datos</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       

			<form action="{{ route('editarGrupo')}}" method="post">
            @csrf               
            	<div>
            		<div class="form-group">
            			<label for="name">Nombre del grupo:</label>
            			<input type="hidden" name="id_grupo" id="id_grupo" >
            			<input type="text" name="nombre" id="edit_name" class="form-control" required="" autofocus="">
            		</div>

            		<h5>Lista de contactos</h5>
            		<table class="table table-striped">
            			<thead>
            				<tr>
            					<th>Nombre</th>
            					<th>Correo</th>
            					<th></th>
            				</tr>
            			</thead>
            			<tbody id="datos_edit">
               			</tbody>
            		</table>
            	</div>
				<hr>
            	<div class="d-flex justify-content-end mt-1">
            		<button type="button" class="btn btn-outline-secondary border-button mr-1" data-dismiss="modal">Cancelar</button>
            		<button type="submit" class="btn btn-primary border-button">Actualizar</button>
            	</div>
            </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Form Edit Contactos -->
	<div class="modal fade" id="form-grupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Crear grupo</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       

			<form action="{{ route('registrarGrupo')}}" method="post">
            @csrf               
            	<div>
            		<div class="form-group">
            			<label for="name">Nombre del grupo:</label>
            			<input type="text" name="nombre" id="name" class="form-control" required="">
            		</div>

            		<h5>Lista de contactos</h5>
            		<table class="table table-striped">
            			<thead>
            				<tr>
            					<th>Nombre</th>
            					<th>Correo</th>
            					<th></th>
            				</tr>
            			</thead>
            			<tbody>
            				@foreach ($contactos as $contacto)
								<tr>
            						<td>{{$contacto->name}} {{$contacto->ap_pat}} {{$contacto->ap_mat}}</td>
            						<td>{{$contacto->email}}</td>
            						<td>
            							<div class="custom-control custom-switch">
			                                <input type="checkbox" class="custom-control-input" id="invitar{{$contacto->id}}" value="{{$contacto->id}}" name="contactos[]">
			                                <label class="custom-control-label" for="invitar{{$contacto->id}}">Agregar</label>
			                            </div>
            						</td>
            					</tr>
            				@endforeach
            				
            			</tbody>
            		</table>
            	</div>
				<hr>
            	<div class="d-flex justify-content-end mt-1">
            		<button type="button" class="btn btn-outline-secondary border-button mr-1" data-dismiss="modal">Cancelar</button>
            		<button type="submit" class="btn btn-primary border-button">Agregar</button>
            	</div>
            </form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal lista integrantes -->
	<div class="modal fade" id="listaDeIntegrantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Lista de Participantes</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
        	<table class="table table-striped table-hover">
        		<thead>
        			<tr>
        				<th>Nombre</th>
        				<th>Correo electronico</th>
        			</tr>
        		</thead>
        		<tbody id="listaDeContactos"></tbody>
        	</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
    
@endsection

@section('scriptjs')
    <script>

        function eliminarGrupo(){

            var response = confirm('Estas seguro de eliminar el grupo');

            if(response){
            	swal({
                  title: "Grupo eliminado",
                  icon: "success",
                });
                return true;
            }else {
                return false;
            }
           
        }

        function getDatosGrupo(id) {
        	jQuery.get('{{route('getDatosGrupo')}}', {id: id}, function(data, textStatus, xhr) {
        	  
        	  $('#edit_name').val(data[0].nombre);
        	  $('#id_grupo').val(data[0].id);
        	 
        	  var tabla_tbody = '';
        	  for(var i = 0; i < data[0].contactos.length; i++){
        	  	tabla_tbody += `<tr>
									<td>${data[0].contactos[i].name} ${data[0].contactos[i].ap_pat} ${data[0].contactos[i].ap_mat}</td>
									<td>${data[0].contactos[i].email}</td>
									<td>
										<div class="custom-control custom-switch">
			                                <input type="checkbox" class="custom-control-input" id="invitar_edit${data[0].contactos[i].id}" value="${data[0].contactos[i].id}" name="contactos[]" ${data[0].contactos[i].activo}>
			                                <label class="custom-control-label" for="invitar_edit${data[0].contactos[i].id}">Agregar</label>
			                            </div>
									</td>
        	  					</tr>`;
        	  }

        	  $('#datos_edit').html(tabla_tbody);
        	
        	});
        	
        }

         function getListaGrupo(id) {
        	jQuery.get('{{route('getDatosGrupo')}}', {id: id}, function(data, textStatus, xhr) {
        	          	  
        	  var tabla_tbody = '';
        	  for(var i = 0; i < data[0].contactos.length; i++){
        	  	if (data[0].contactos[i].activo === false) {} 
        	  		else {
        	  		tabla_tbody += `<tr>
									<td>${data[0].contactos[i].name} ${data[0].contactos[i].ap_pat} ${data[0].contactos[i].ap_mat}</td>
									<td>${data[0].contactos[i].email}</td>
        	  						</tr>`;
        	  	}
        	  	
        	  }

        	  $('#listaDeContactos').html(tabla_tbody);
        	
        	});
        	
        }

        
    </script>
@endsection