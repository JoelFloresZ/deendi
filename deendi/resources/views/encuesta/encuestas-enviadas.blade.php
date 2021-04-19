@extends('layouts.plantilla')
@section('title', 'Encuestas enviadas')
{{-- Formulario de busqueda --}}


@section('content')
	<div class="container-fluid">
		
        <div class="p-2 my-3 text-white-50 bg-purple rounded shadow">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-center p-1"> 
                    <h5 class="mb-0 text-white lh-100">Encuestas enviadas</h5>
                </div>        
            </div>
        </div>
		{{-- lista de encuestas --}}

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Usuarios de DEENDI <span class="badge badge-primary px-1">{{count($encuestas)}}</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Correo electrónico <span class="badge badge-primary px-1">{{count($encuestas_email)}}</span> </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {{-- {{json_encode($encuestas)}} --}}
                @if (count($encuestas) > 0)
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-inverse bg-dark text-white">
                            <tr>
                                <th class="w-75">Encuesta</th>
                                <th class="w-25">Usuario</th>
                                <th class="w-25"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($encuestas as $encuesta)
                                <tr>
                                    <td>
                                        <p class="text-gray-dark ">
                                            {{$encuesta['encuestas'][0]->titulo}}
                                        </p>
                                        <small>Enviado hace: {{$encuesta['created_at']->diffForHumans()}}</small>
                                    </td>
                                    <td>
                                        <p>{{$encuesta['email']}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <form action="{{route('eliminarEncuestaUsuarioEnviado', $encuesta['id'])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-light btn-sm text-dark" onclick="return deleteEncuestas()"><i class="fa fa-trash h5"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                            
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                        <div class="text-center">
                            <img src="{{asset('img/img-view/enviados.svg')}}" class="img-fluid" width="250px">
                            <h2 class="font-weight-bold text-center">No ha compartido ninguna encuesta</h2>
                            <p class="text-center">Cuando comparta una encuesta, aquí se mostrarán todas las encuestas que comparta a todos los usuarios de la plataforma.</p>
                        </div>
                    </div>
                @endif

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               
                @if(count($encuestas_email) > 0)
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-inverse bg-dark text-white">
                            <tr>
                                <th class="w-75">Encuesta</th>
                                <th class="w-25">Correo</th>
                                <th class="w-25"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($encuestas_email as $encuesta)
                                <tr>
                                    <td>
                                        <p class="text-gray-dark ">
                                            {{$encuesta['encuestas'][0]->titulo}}
                                        </p>
                                        <small>Enviado hace: {{$encuesta['created_at']->diffForHumans()}}</small>
                                    </td>
                                    <td>
                                        <p>{{$encuesta['email']}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <form action="{{route('eliminarEncuestaEmailEnviado', $encuesta['id'])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-light btn-sm text-dark" onclick="return deleteEncuestas()"><i class="fa fa-trash h5"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                            
                        </tbody>
                    </table>
                @else
                    <div class="mt-4">
                        <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                            <div class="text-center">
                            <img src="{{asset('img/img-view/enviados.svg')}}" class="img-fluid" width="250px">
                            <h2 class="font-weight-bold text-center">No ha compartido ninguna encuesta</h2>
                            <p class="text-center">Cuando comparta una encuesta, aquí se mostrarán todas las encuestas que comparta a todos los usuarios por correo electrónico.</p>
                        </div>
                        </div>
                    </div>
                @endif
                

            </div>
        </div>
		            
	</div>
    
@endsection

@section('scriptjs')
    <script>

        function deleteEncuestas(){

            var response = confirm('Estas seguro de eliminar la encuesta');

            if(response){
                swal({
                  title: "Encuesta compartido eliminado",
                  icon: "success",
                });
                return true;
            }else {
                return false;
            }
           
        }

        
    </script>
@endsection