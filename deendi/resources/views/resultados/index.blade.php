@extends('layouts.plantilla')
@section('title', 'Resultados')
{{-- Formulario de busqueda --}}
@section('form-sarch')
    {{-- <x-formsearch metodo="GET" ruta="{{ route('buscarEncuestaAplicado') }}"  buscar="Buscar encuesta aplicado"></x-formsearch> --}}

    @component('components/formsearch', ['metodo' => 'GET', "buscar" => "Buscar encuesta aplicado" ])
    	{{ route('buscarEncuestaAplicado') }}
    @endcomponent

@endsection

@section('content')
	<div class="container-fluid">
		<div class="p-3 my-3 text-white-50 rounded shadow" style="background: #46ab6c;">
            
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center"> 
                    <h6 class="mb-0 text-white lh-100">{{$ver ?? 'Encuestas aplicadas'}}</h6>
                </div>        
            </div>
        </div>
		{{-- lista de encuestas --}}
		
    	<div>
    		@if (count($encuestas_aplicadas) > 0)
	     		<table class="table shadow">
	     			<thead class="thead-inverse bg-white">
	     				<tr>
	     					<th scope="col" class="w-50">Encuesta</th>
	     					<th scope="col" class="w-25">Aplicado</th>
	     					<th scope="col" class="w-25"></th>
	     				</tr>
	     			</thead>
	     			<tbody>
	     				 @foreach($encuestas_aplicadas as $encuesta)
	     				 	<tr>
	     				 		<td>{{$encuesta['titulo']}}</td>
	     				 		<td>
	     				 			<p><span class="badge badge-primary px-3 py-1 ml-1">{{$encuesta['num_encuesta_aplicado']}}</span></p>
	     				 		</td>
	     				 		<td>	
	     				 			<div class="d-flex justify-content-center">
	     				 				<a class="btn btn-light btn-sm text-dark" href="{{route('verResultadoResume',encrypt($encuesta['id']))}}">
	     				 					<i class="fa fa-chart-bar h5"></i>
	     				 				</a>
	                				
	                				<form method="POST" action="{{route('limpiarDatos', $encuesta['id'])}}">
	                					@csrf
	                					<button type="submit" class="btn btn-light btn-sm text-dark" onclick="return limpiarDatosEncuestas()" >
	                						<i class="fa fa-trash-restore-alt h5"></i>
	                					</button>
	                				</form>
	     				 			</div>
	                			</td>
	     					</tr>
	     	   			@endforeach
	     			</tbody>
	     		</table>   
	     		<div class="mt-5">
	     			{{ $encuestas_aplicadas->links() ?? ''}}
	     		</div>     
			@else
			    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
			    	@switch($ver ?? '')
                        @case('Resultado')
                            <div class="text-center">
								<img src="{{asset('img/img-view/busqueda.svg')}}" class="img-fluid" width="200px">
                                <h2 class="font-weight-bold text-center">No hubo resultados de la búsqueda</h2>
                                <div class="text-center">
                                    <p class="text-center"><i class="fa fa-angle-double-left"></i></p>
                                    <a href="{{ route('resultados')}}">Regresar</a>
                                </div>
                                
                            </div>
                            @break   

                        @default
                            <div class="text-center">
								<img src="{{asset('img/img-view/resultados.svg')}}" class="img-fluid" width="200px">
		                    	<h2 class="font-weight-bold text-center">No hay encuestas que analizar</h2>
		                    	<p class="text-center">Cuando aplique una encuesta, aquí se mostrarán todas las encuestas aplicadas.</p>
		                    </div>
                    @endswitch
                </div>
			@endif
    	</div>	
	</div>


	<div class="modal fade" id="model2Id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

        function limpiarDatosEncuestas(){

            var response = confirm('Estas seguro de eliminar los datos de la encuesta');

            if(response){
            	swal({
                  title: "Datos eliminado",
                  icon: "success",
                });
                return true;
            }else {
                return false;
            }
           
        }

        
    </script>
@endsection