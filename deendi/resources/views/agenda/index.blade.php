@extends('layouts.plantilla')
@section('title', 'Agenda de contactos')
{{-- Formulario de busqueda --}}
@section('form-sarch')
    {{-- <x-formsearch metodo="GET" ruta="{{ route('buscarContacto') }}"  buscar="Buscar contacto por nombre"></x-formsearch> --}}
    @component('components/formsearch', 
    	['metodo' => 'GET', "buscar" => "Buscar contacto por nombre"])
    	{{ route('buscarContacto') }}
    @endcomponent
@endsection

@section('content')
	<div class="container-fluid">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom ">
        	<h1 class="h3">{{$ver ?? 'Contactos'}}</h1>
	     	<div>
	     		
	     	</div>
    	</div>
		{{-- lista de encuestas --}}
		
    	<div>
    		@if (1)
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
			    	
			    	<div class="row">
			    		
			    		@if(count($contactos) > 0)
							<div class="col-12">
				    			<div class="card">
						    		<table class="table">
									  <thead class="thead-inverse" style="border-bottom:1px solid blue;">
									    <tr>
									      <th scope="col">Nombre</th>
									      <th scope="col">Apellido Paterno</th>
									      <th scope="col">Apellido Materno</th>
									      <th scope="col">Correo</th>
									      <th scope="col">
									      	<div class="d-flex justify-content-end">
									      		<button type="button" class="btn btn-primary border-button" data-toggle="modal" data-target="#contactos">
											  Nuevo contacto
											</button>
									      	</div>
									      </th>
									    </tr>
									  </thead>
									  <tbody>
									  	@foreach($contactos as $contacto)
											<tr>
										      <td>{{$contacto->name}}</td>
										      <td>{{$contacto->ap_pat}}</td>
										       <td>{{$contacto->ap_mat}}</td>
										      <td>{{$contacto->email}}</td>
										      <td>
										      	<div class="d-flex justify-content-end">
										      		<button class="btn btn-outline-light btn-sm text-dark mr-1" data-toggle="modal" data-target="#edit_contacto" onclick="getDatosContacto({{$contacto->id}})" ><i class="fa fa-edit h5"></i></button>
										      		<form method="POST" action="{{route('eliminarContacto', $contacto->id)}}">
										      			@csrf
										      			<button class="btn btn-outline-light btn-sm text-dark" onclick="return eliminarContacto()" ><i class="fa fa-trash h5"></i></button>
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
								<div>
									@switch($ver ?? '')
				                        @case('Resultado')
				                            <div>
				                                <h2 class="font-weight-bold text-center">No hubo resultados de la búsqueda del contacto</h2>
				                                <div class="text-center">
				                                    <p class="text-center"><i class="fa fa-angle-double-left"></i></p>
				                                    <a href="{{ route('agenda')}}">Regresar</a>
				                                </div>
                                			</div>
				                            @break  

				                        @default
				                            <div class="text-center">
												<div>
													<img src="{{asset('img/img-view/contactos.svg')}}" class="img-fluid" width="160px">
													<h2 class="font-weight-bold text-center">No hay ningún contacto registrado para mostrar</h2>
													<p>Aquí se mostrarán todos tus contactos que registres.</p>
													<div class="">
										      			<button type="button" class="btn btn-outline-secondary mr-5" data-toggle="modal" data-target="#contactos">
												  		<i class="fa fa-plus  display-4"></i>
													</button>
													</div>
												</div>
											</div>
				                    @endswitch
								</div>
			    		@endif
			    		
			    	</div>
			    </div>
			@else
			    I don't have any records!
			@endif
    	</div>	
	</div>


	<!-- Button trigger modal -->
	

	<!-- Modal Form Contactos -->
	<div class="modal fade" id="contactos" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Contactos</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       

			<form action="{{ route('registrarContacto')}}" method="post">
            @csrf               
                <div class="container-fluid">
                         <div>
                             <label for="nombre">Nombre:</label>
                             <input type="text" class="form-control" id="nombre" name="nombre" required >
                            @error('nombre')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="paterno">Apellido paterno:</label>
                             <input type="text" class="form-control" id="paterno" name="ap_pat" required >
                            @error('ap_pat')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="materno">Apellido materno:</label>
                             <input type="text" class="form-control" id="materno" name="ap_mat" required >
                            @error('ap_mat')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="correo">Correo electronico:</label>
                             <input type="email" class="form-control" id="email" name="correo" required >
                             <small class="form-text text-black-50">El correo electronico debe de ser de un servidor de Gmail, Hotmail o Outlook y Yayoo</small>
                            @error('correo')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                         </div>

                         <div class="mt-2">
                             <div class="custom-control custom-switch">
                                 <input type="checkbox" class="custom-control-input" id="invitar" value="1" name="invitar">
                                 <label class="custom-control-label" for="invitar">Invitar contacto a unirse a la plataforma</label>
                             </div>
                         </div>
                </div> 

                 <div class="modal-footer">
			        <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal">Cerrar</button>
			         <button type="submit" class="btn btn-primary border-button" data-toggle="modal" data-target="#model2Id">Registrar</button>
			      </div>  
           </form>


	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal Form Edit Contactos -->
	<div class="modal fade" id="edit_contacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-scrollable" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <h5 class="modal-title text-white" id="exampleModalScrollableTitle">Contactos</h5>
	        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       

			<form action="{{ route('editarContacto')}}" method="post">
            @csrf               
                <div class="container-fluid">
                         <div>
                         	<input type="hidden" name="id_contacto" id="id_contacto">
                             <label for="nombre">Nombre:</label>
                             <input type="text" class="form-control" id="edit_nombre" name="nombre" required >
                            @error('nombre')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="paterno">Apellido paterno:</label>
                             <input type="text" class="form-control" id="edit_paterno" name="ap_pat" required >
                            @error('ap_pat')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="materno">Apellido materno:</label>
                             <input type="text" class="form-control" id="edit_materno" name="ap_mat" required >
                            @error('ap_mat')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                            
                         </div>

                         <div>
                             <label for="correo">Correo electronico:</label>
                             <input type="email" class="form-control" id="edit_email" name="correo" required >
                             <small class="form-text text-black-50">El correo electronico debe de ser de un servidor de Gmail, Hotmail o Outlook y Yayoo</small>
                            @error('correo')
				                <span class="text-danger">{{ $message }}</span>
				            @enderror 
                         </div>

                         <div class="mt-2">
                             <div class="custom-control custom-switch">
                                 <input type="checkbox" class="custom-control-input" id="edit_invitar" value="1" name="invitar">
                                 <label class="custom-control-label" for="invitar">Invitar contacto a unirse a la plataforma</label>
                             </div>
                         </div>
                </div> 

                 <div class="modal-footer">
			        <button type="button" class="btn btn-outline-secondary border-button" data-dismiss="modal">Cerrar</button>
			         <button type="submit" class="btn btn-primary border-button" data-toggle="modal" data-target="#model2Id">Actualizar</button>
			      </div>  
           </form>


	      </div>
	    </div>
	  </div>
	</div>

{{-- Moda de carga --}}
	<div class="modal fade" id="model2Id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="z-index: 1500;">
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

        function eliminarContacto(){

            var response = confirm('Estas seguro de eliminar el contacto');

            if(response){
            	swal({
                  title: "Contacto eliminado",
                  icon: "success",
                });
                return true;
            }else {
                return false;
            }
           
        }

        function getDatosContacto(id) {
        	jQuery.get('{{route('getDatosContacto')}}', {id: id}, function(data, textStatus, xhr) {
        	  console.log(data);
        	  $('#edit_nombre').val(data[0].name);
        	  $('#edit_paterno').val(data[0].ap_pat);
        	  $('#edit_materno').val(data[0].ap_mat);
        	  $('#edit_email').val(data[0].email);
        	  $('#id_contacto').val(data[0].id);
        	});
        	
        }

        
    </script>
@endsection
