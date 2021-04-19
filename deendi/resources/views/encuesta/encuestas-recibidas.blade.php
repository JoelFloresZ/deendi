@extends('layouts.plantilla')
@section('title', 'Encuestas recibidas')
{{-- Formulario de busqueda --}}


@section('content')
	<div class="container-fluid">
        <div class="p-2 my-3 text-white-50 bg-purple rounded shadow">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center p-1"> 
                    <h5 class="mb-0 text-white lh-100">Encuestas recibidas</h5>
                </div>        
            </div>
        </div>
		
		{{-- lista de encuestas --}}
		
    	<div>
    		@if (count($encuestas))
			    <div class="px-3 py-1">
			    	
			    	 @foreach($encuestas as $encuesta)

                       	<div class="row p-1 mb-3 shadow-sm bg-white rounded" style="border-left: 4px solid blue;">
                            <div class="col-8 media text-muted">                         
                                <p class="media-body mb-0 small lh-125 border-gray">
                                
                                    <strong class="d-block text-gray-dark h5">

										{{$encuesta['encuestas'][0]->titulo}}
                                    </strong>
                                    Recibido hace: {{$encuesta['created_at']->diffForHumans()}}
                                </p>
                            </div>
                            <div class="col-4 p-2">
                            	<div class="d-flex justify-content-between float-right">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{$encuesta['asunto']}}">
                                      <button class="btn btn-light btn-sm" style="cursor: pointer;" type="button" disabled>
                                          <i class="fa fa-envelope h5"></i>
                                      </button>
                                    </span>
                            		<a href="{{route('showEncuestaEmail', encrypt($encuesta['encuesta_id']) )}}" class="btn btn-outline-light text-dark btn-sm mr-1" target="_blank"><i class="fa fa-clipboard h5"></i></a>
                            		<form action="{{route('eliminarEncuestaRecibido', $encuesta['id'])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-light btn-sm text-dark" onclick="return deleteEncuestas()"><i class="fa fa-trash h5"></i></button>
                                    </form>
                            	</div>
                            </div>
                       	</div>

                    @endforeach
			    </div>
			@else
			    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                    <div class="text-center">
                        <img src="{{asset('img/img-view/recibidos.svg')}}" class="img-fluid" width="200px">
                        <h2 class="font-weight-bold text-center">No hay encuestas recibidas</h2>
                        <p class="text-center">Cuando reciba una encuesta, aquí se mostrarán todas las encuestas que reciba de otros usuarios de la plataforma.</p>
                    </div>
                </div>
			@endif
    	</div>	
	</div>
    
@endsection

@section('scriptjs')
    <script>

        function deleteEncuestas(){

            var response = confirm('Estas seguro de eliminar la encuesta');

            if(response){
                swal({
                  title: "Encuesta recibido eliminado",
                  icon: "success",
                });
                return true;
            }else {
                return false;
            }
           
        }

        
    </script>
@endsection