@extends('layouts.plantilla')
@section('title', 'Crear-encuesta')


@section('content')
  <div class="container-fluid">

    <h5 class="mt-4">Craer nueva encuesta</h5>

    <div class="card mt-3 shadow w-75 p-4">
      <form method="POST" action="{{route('crearEncuesta')}}">
        @csrf
        <div class="form-group">
          <label>Título  de la encuesta</label>
          <textarea name="titulo" id="titulo" placeholder="Título " class="@error('titulo') is-invalid @enderror form-control" autofocus="" rows="1" value="{{old('titulo')}}"></textarea>
           @error('titulo')
                <span class="text-danger">{{ $message }}</span>
            @enderror   
        </div>

        <div class="form-group">
          <label>Descripción / Instructivos</label>
          <textarea name="descripcion" id="descripcion" class="@error('descripcion') is-invalid @enderror form-control" placeholder="Descripción" value="{{old('descripcion')}}"></textarea>
          @error('descripcion')
                <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="d-flex justify-content-end">
          <a class="btn btn-outline-secondary border-button" href="{{ route('home')}} ">Cancelar</a>
          <button type="submit" class="btn btn-primary ml-2 border-button" data-toggle="modal" data-target="#model2Id">Crear encuesta</button>
        </div>
      </form>
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