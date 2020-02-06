<template>
<div>
<form action="./api/cliente" method="POST" @submit.prevent="agregarCliente()">
    <div class="container-fluid">
        <div class="modal fade modal-open" id="ModalAgregarCliente" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0 p-lg-3">
                <div class="modal-header border-0 tituloModalCliente">
                    <span>Agregar nuevo cliente</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <span>Nombre</span>
                            <input class="form-control rounded-0" name="nombre" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Correo electrónico</span>
                            <input class="form-control rounded-0" type="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <span>Edad</span>
                            <input class="form-control rounded-0" type="text"  name="edad">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <span>Descripción</span>
                            <textarea class="form-control rounded-0" type="text" name="descripcion">
                            </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label >Categoría</label>
                            <select class="form-control rounded-0" name="categoria">
                                <option selected disabled>Selecciona una categoría</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-secondary btn btn-success" >Guardar</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('componente montado')
        },
        methods: {
            agregarCliente() {
                axios.post('./api/cliente', {
                    nombre: 'something',
                    email: 'correo',
                    edad: 22,
                    descripcion: 'no comentarios',
                    categoria: 'cate1'
                    });
                alert('agregando cliente');
            }
        }
    }
</script>