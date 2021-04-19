@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
       
            <div class="card p-3 px-5 mt-3 shadow" style="width: 350px; border-radius: 8px; border-bottom: 2px solid #308cd7;">
                <div class="font-weight-bold text-center my-4 h4">
                    {{ __('Iniciar sesión') }}
                </div>
                
                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                           
                            <div class="custom-control custom-switch">
                              <input type="checkbox" name="remember" id="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                              <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-center mt-3 mb-2">
                            <button type="submit" class="btn btn-primary border-button mt-3" style="border-radius: 20px;">
                                {{ __('Iniciar sesión') }}
                            </button>                            
                        </div>

                        <div class="text-center mb-4 mt-3">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-muted" href="{{ route('password.request') }}">
                                    {{ __('Olvido su contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        
    </div>
</div>
@endsection
