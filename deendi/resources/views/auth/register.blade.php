@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow" style="border-radius: 8px; border-bottom: 2px solid #308cd7;">
                <div class="card-body">
                    <div class="h4 text-center mt-4 mb-2 font-weight-bold">{{ __('Registro') }}</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-form-label">{{ __('Name') }}</label>

                             <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="apellido_pat" class="col-form-label">{{ __('Primer apellido') }}</label>

                             <input id="apellido_pat" type="text" class="form-control @error('apellido_pat') is-invalid @enderror" name="apellido_pat" value="{{ old('apellido_pat') }}" required autocomplete="apellido_pat" autofocus>

                                @error('apellido_pat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="apellido_mat" class="col-form-label">{{ __('Segundo apellido') }}</label>

                             <input id="apellido_mat" type="text" class="form-control @error('apellido_mat') is-invalid @enderror" name="apellido_mat" value="{{ old('apellido_mat') }}" required autocomplete="apellido_mat" autofocus>

                                @error('apellido_mat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <small id="emailHelp" class="form-text text-muted">Mínimo 8 caracteres, pueden ser números y alfanuméricos.</small>


                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div>
                            <a href="{{url('/terminos')}}" target="_blank">Terminos y condiciones</a></label>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="custom-checkbox">
                                    <label class="custom-control" data-toggle="modal" class="text-primary" data-target="#terminosycondiciones">
                                    <input type="checkbox" name="terminos" id="terminos" class="form-check-input @error('terminos') is-invalid @enderror"
                                    required="" value="1">
                                   Aceptar Terminos</label>
                                </div>

                                 @error('terminos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group mb-1">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" style="border-radius: 20px;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
