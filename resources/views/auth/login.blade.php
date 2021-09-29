@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"
                                                                                                                                                                                                                                                                                                                                                                                                                                                autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar Sesión') }}
                                </button>

                                <a class="btn btn-link" href="/forget-password">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="container pie-formulario col-md-12">
        <div class="col-md-6 text-center">
            <p>¿No tienes tienes una cuenta?</p>
        </div>
        <div class="col-md-6 text-center">
            <a href="/registrarse">Registrarse</a>
        </div>
        <div class="col-md-12 text-center">
            <p>Iniciar Sesión con</p>
        </div>
        <div class="col-md-12 text-center">
            <ul>
                <li>
                    <a href=" {{ route('login.facebook') }} "><img src="images/icons/facebook.png" class="img-responsive" alt="" /></a>
                </li>
                <li>
                    <a href=" {{ route('login.google') }} "><img src="images/icons/google.png" class="img-responsive" alt="" /></a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection