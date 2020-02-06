@extends('layouts.app')

@section('content')
<div class="container-fluid loginFondo">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-login">

                <div class="card-body">
                <div class="row" >
                    <div class="col" align="center">
                        <img src="storage/logotipo.png"  width="125" height="100">
                        <br>
                        <span class="welcome">¡Bienvenido!</span>
                    </div>
                </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" >Usuario</label>
                                <input placeholder="Ingresa tu usuario"
                                    id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" >Contraseña</label>
                                <input placeholder="Ingresa tu contraseña"
                                    id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">

                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <span class="botonSesion">
                                        INICIAR SESIÓN
                                    </span>
                                </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
