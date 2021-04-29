@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-white h5 p-3">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    {{-- }
                        Se cambio el POST por el GET ya que marcaba un error el solicitar el link de restablecer
                        contraseña modificado el (22/04/2021 : 01:32:am)
                        Error que mostraba: The method post no es soport, soport method="GET, HEAD";
                        Este errro ocurrio en el servidor.
                        Si cuando ejecute se da el mismo error cambiar POST x GET.
                        --}}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
