@extends('layouts.app')

@section('content')

    <!-- MENU -->
    <nav class="navbar navbar-expand-md navbar-light nav-fondo">
        <div class="container-fluid">

            <a href="javascript:void(0)" class="" v-on:click="toggleModalImagen">
                <img @change="mostrarImagen"  :src="'storage/'+imagen"  width="75" height="50">
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

    <!-- debajo del menu -->
    <div class="container-fluid topHome">
            <div class="row ">
                <div class="col-md-4">
                    <span class="listadoClientes">Listado de clientes</span>
                </div>

                <div class="col-md-4">
                    <div v-if="mostrarInformacion" :class="'alert '+alert" @cambio-color="updateColor">
                        @{{  informacion }}
                    </div>
                </div>

                <div class="col-md-4" align="right">

                    <button v-on:click="toggleModal" class="btn btn-success">
                           Agregar nuevo cliente
                    </button>


                </div>
            </div>
    </div>

    <!--  BUSQUEDA  -->
    <form @submit.prevent="busquedaClientes(busqueda)">
        <div class="container-fluid busqueda">
            <div class="row">
                <div class="col-md-1">

                </div>

                <div class="col-md-1 text-justify text-sm-center">
                    <label class="pt-2">Búsqueda</label>
                </div>
                <div class="col-md-9">
                    <input v-model="busqueda" name="busqueda" class="form-control rounded-0" type="text" placeholder="Nombre/Edad/Correo">
                </div>
                <div class="col-md-1" align="right">
                    <button class="btn btn-primary  btn-block">Buscar</button>
                </div>

            </div>
        </div>
    </form>

    <!-- IMAGEN -->
    <div v-if="showModalImagen" @close="close">
        <form method="POST" @submit.prevent="getImage" enctype="multipart/form-data" >
        <div  class="modal-mask" >
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header border-0">
                        <slot name="header">
                            <h5><b>Editar imagen</b></h5>
                        </slot>
                        <button type="button" @click="close"  class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Selecciona una imagen</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="custom-file">
                                    <input accept="image/png, image/jpeg" @change="cambioImagen" required
                                         name="imagen" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <slot name="footer">
                            <button type="submit" class="btn btn-secondary btn btn-success" >Guardar</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- TABLA INFORMACION -->
    <div>
        <div class="container-fluid listado">

                <table class="table table-striped">
                    <thead>
                    <tr class="table-active" >
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CORREO ELECTRÓNICO</th>
                        <th>CATEGORIA</th>
                        <th>EDAD</th>
                        <th>OPCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr></tr>
                    <tr v-for="cliente in clientes" :key="cliente.id">
                        <td >
                            @{{ cliente.id }}
                        </td>
                        <td >
                            @{{ cliente.nombre_cliente }}
                        </td>
                        <td >
                            @{{ cliente.email }}
                        </td>
                        <td >
                            @{{ cliente.categoria }}
                        </td>
                        <td >
                            @{{ cliente.edad }}
                        </td>
                        <td>

                            <a href="javascript:void(0)" v-on:click="toggleModalEdit(cliente)">
                                Editar
                            </a>
                            |
                            <a href="#" @click.prevent="borrarCliente(cliente.id)">Borrar</a>

                        </td>
                    </tr>
                    </tbody>
                </table>

        </div>

        <modal-editar
            :cliente="clienteEditar"
            @close="showModalEditar = false"
            @cambiar-info="cambiarInformacion"
            v-if="showModalEditar" >
                <h5 slot="header"><b>Editar cliente</b></h5>
        </modal-editar>

        <modal-agregar
            v-if="showModal"
            @close="showModal = false"
            @info-agregar="cambiarInformacionAgregar"
            @listar-cliente="listarClientes">
            <h5 slot="header"><b>Agregar nuevo cliente</b></h5>
        </modal-agregar>

    </div>
@endsection
