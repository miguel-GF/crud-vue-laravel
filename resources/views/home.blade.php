@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-md navbar-light nav-fondo">
        <div class="container-fluid">

            <a href="#" class="" data-toggle="modal" data-target="#ModalCambiarImagen">
                <img src="{{ asset('storage/logotipo.png') }}"  width="75" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <ul class="navbar-nav mr-auto">
                    <li><span class="tituloHome pr-4 pl-2"> | </span></li>
                    <li></li>
                    <li><span class="tituloHome">Gestor clientes</span></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a class="text-white linkCerrarSesion" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Cerrar sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid topHome">
            <div class="row ">
                <div class="col-md-4">
                    <span class="listadoClientes">Listado de clientes</span>
                </div>
                <div  class="col-md-4">
                    @if (session('status'))
                        <div v-show="elementVisible" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-4" align="right">
                    <button type="button" class="btn btn-success"
                            data-toggle="modal" data-target="#ModalAgregarCliente">
                            Agregar nuevo cliente
                    </button>
                </div>
            </div>
    </div>

    <div class="container-fluid busqueda">
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-1 text-justify text-sm-center">
                <span>Búsqueda</span>
            </div>
            <div class="col-md-9">
                <input class="form-control rounded-0" type="text" placeholder="Nombre/Edad/Correo">
            </div>
            <div class="col-md-1" align="right">
                <button class="btn btn-primary  btn-block">Buscar</button>
            </div>
        </div>
    </div>

    <cambiar-imagen-component></cambiar-imagen-component>
    <table-component></table-component>
    <agregar-cliente-component></agregar-cliente-component>
{{--    <editar-cliente-component></editar-cliente-component>--}}

@endsection
