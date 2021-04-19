@extends('layouts.plantilla')
@section('title', 'Inicio')
{{-- Formulario de busqueda --}}
@section('form-sarch')
    {{-- <x-formsearch metodo="GET" ruta="{{ route('buscarEncuesta') }}" buscar="Buscar encuesta"></x-formsearch> --}}

    @component('components/formsearch', ['metodo' => 'GET', "buscar" => "Buscar encuesta" ])
    {{ route("buscarEncuesta") }}
    @endcomponent
@endsection

@section('content')
    <div class="container-fluid"> 
        <div class="p-2 m-lg-3 m-md-3 my-sm-0 my-1  text-white-50 bg-purple rounded shadow">
            
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center"> 
                    <h6 class="mb-0 text-white lh-100">{{$ver ?? 'Encuestas'}}</h6>
                </div>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="dropdown">
                        <a class="btn btn-sm btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mostra encuestas
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('home') }}">Todos</a>
                            <a class="dropdown-item" href="{{ route('listaEncuestasTerminadas') }}">Encuestas terminadas</a>
                            <a class="dropdown-item" href="{{ route('listaEncuestasPendientes') }}">Encuestas pendientes</a>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            @if (count($encuestas_user) === 0)
                <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                    @switch($ver ?? '')
                        @case('Resultado')
                            <div class="text-center">
                                <img src="{{asset('img/img-view/busqueda.svg')}}" class="img-fluid" width="200px">
                                <h2 class="font-weight-bold text-center">No hubo resultados de la búsqueda</h2>
                                <div class="text-center">
                                    <p class="text-center"><i class="fa fa-angle-double-left"></i></p>
                                    <a href="{{ route('home')}}">Regresar</a>
                                </div>
                                
                            </div>
                            @break

                        @case('Pendientes')
                            <h2 class="font-weight-bold text-center">No tiene encuestas pendientes para mostrar</h2>
                            @break

                        @case('Terminadas')
                            <h2 class="font-weight-bold text-center">No tiene encuestas terminadas para mostrar</h2>
                            @break    

                        @default
                            <div>
                                <div class="w-100 text-center">
                                    <img src="{{asset('img/img-view/encuestas.svg')}}" class="img-fluid" width="250px">
                                    <h2 class="font-weight-bold text-center">No tiene ninguna encuesta generado para mostrar</h2>
                                </div>
                                <div class="w-75 m-auto text-center">
                                    <p>
                                        Aquí se mostrarán todas las encuestas que genere tales como encuestas terminadas y encuestas sin terminar.
                                    </p>
                                </div>
                            </div>
                    @endswitch
                    
                </div>

            @else

                @foreach($encuestas_user as $encuesta)
                        <div class="card mb-2 shadow">
                           <div class="container-fluid">
                                <div class="row rounded">
                                    @if($encuesta->estado_encuesta === 'pendiente')
                                        <div class="col-lg-1 col-sm-0 col-0 d-flex align-items-center rounded d-none" style="border-left:5px solid gray;">
                                            <i class="fa fa fa-circle h3 text-muted ml-3"></i>
                                        </div>
                                    @else
                                        <div class="col-1 d-flex align-items-center rounded" style="border-left:5px solid #43e199;">
                                            <i class="fa fa-check-circle h3 text-success ml-3"></i>
                                        </div>
                                    @endif

                                    <div class="col-lg-8 col-sm-7 p-2">
                                        <p class="font-weight-bold m-0 p-0" style="font-size: 14px;">{{$encuesta->titulo}}</p>
                                        <small class="m-0 small text-muted pb-0 mb-0">Creado {{$encuesta->created_at->diffForHumans()}}</small>
                                    </div>

                                    <div class="col-lg-3 col-sm-5 py-2">
                                        <div class="container-fluid">
                                            @if($encuesta->estado_encuesta === 'pendiente')
                                               <div class="d-flex justify-content-center float-right">
                                                    <a class="btn btn-light btn-sm text-dark" href="{{route('mostrarEncuestaEnProceso', encrypt($encuesta->id))}}" target="_blank"><i class="fa fa-eye h5"></i></a>
                                                    <a class="btn btn-light btn-sm text-dark" 
                                                    href="{{route('editarEncuesta',  encrypt($encuesta->id) )}}"><i class="fa fa-edit h5"></i></a>
                                                    <form method="get" action="{{ route('eliminarEncuesta', $encuesta->id)}}">
                                                        <button type="submit" class="btn btn-light btn-block btn-sm text-dark" 
                                                        onclick="return deleteEncuestas()"><i class="fa fa-trash h5"></i></button>
                                                    </form>
                                                    
                                               </div>   
                                            @else                                       
                                                <div class="d-flex justify-content-between float-right">
                                                    <a class="btn btn-light btn-sm text-dark" href="{{route('mostrarEncuestaEnProceso', encrypt($encuesta->id))}}" target="_blank"><i class="fa fa-eye h5"></i>
                                                    </a>
                                                    <a class="btn btn-light btn-sm text-dark" href="{{route('aplicarEncuesta', encrypt($encuesta->id))}}" target="_blank"><i class="fa fa-clipboard h5"></i>
                                                    </a>

                                                    <div class="dropdown">
                                                        <button class="btn btn-light btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v h5 px-1"></i>
                                                        </button>

                                                        <div class="dropdown-menu mr-4" aria-labelledby="dropdownMenu2">
                                                            <a class="dropdown-item" href="{{route('vistaCompartir', encrypt($encuesta->id))}}">
                                                                <i class="fa fa-share-square"></i> Compartir
                                                            </a>
                                                            <form method="get" action="{{ route('eliminarEncuesta', $encuesta->id)}}">
                                                                <button type="submit" class="dropdown-item" onclick="return deleteEncuestas()">
                                                                    <i class="fa fa-trash mr-2"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                        
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                @endforeach

                <div class="mt-5">
                    {{ $encuestas_user->links() ?? '' }}
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
                  title: "Encuesta eliminado",
                  icon: "success",
                });
                
                return true;
            }else {
                return false;
            }
           
        }

        
    </script>
@endsection