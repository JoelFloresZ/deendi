@extends('layouts.plantilla')
@section('title', 'Compartir')
{{-- Formulario de busqueda --}}


@section('content')
  <div class="container-fluid p-lg-2 p-md-2 p-sm-0">
    <div class="container mt-2">
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

      @if ( session('warning') )
          <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
          </div>
      @endif

      <div>
        {{$contactos_no_registrados ?? ''}}
      </div>

      <div class="d-flex justify-content-between">
        <div class="w-50">
          <h5>Compartir encuesta</h5><hr>

          <div class="card p-lg-3 p-md-2 p-sm-2 shadow mt-1 d-flex justify-content-between">
            <form method="post" action="{{route('campartirEncuesta')}}">
              @csrf
              <input type="hidden" name="encuesta_id" id="encuesta_id" value="{{$id}}">
              <formemail></formemail>
              <div class="form-group">
                 <a href="{{route('home')}}" class="btn btn-outline-secondary mr-1 border-button">Cancelar</a>
                <button type="submit" class="btn btn-success border-button">Enviar</button>
              </div>
            </form>         
          </div>

        </div>
      </div>
    </div>   
      
  </div>
    
@endsection