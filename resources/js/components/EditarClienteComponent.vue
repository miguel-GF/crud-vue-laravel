<template>
    <div>

        <div class="container-fluid">
            <div class="modal fade modal-open" :id="'ModalEditarCliente'+datosClientes.edad" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0 p-lg-3">
                        <div class="modal-header border-0 tituloModalCliente">
                            <span>Editar cliente</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <span>Nombre</span>
                                    <input v-model="datosClientes.nombre_cliente"
                                        class="form-control rounded-0" name="nombre" type="text" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Correo electrónico</span>
                                    <input v-model="datosClientes.email"
                                           class="form-control rounded-0" type="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <span>Edad</span>
                                    <input v-model="datosClientes.edad"
                                        class="form-control rounded-0" type="text"  name="edad" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <span>Descripción</span>
                                    <textarea v-model="datosClientes.descripcion"
                                        class="form-control rounded-0" type="text" name="descripcion">
                            </textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Categoría</label>
                                    <select class="form-control rounded-0">
                                        <option disabled>Selecciona una categoría</option>
                                        <option :value="datosClientes.id_categoria" selected >{{datosClientes.categoria}}</option>

                                        <option
                                            :value="c.cliente_categoria_id"
                                            v-for="c in categorias"
                                            v-if="datosClientes.id_categoria!= c.cliente_categoria_id" >

                                             {{ c.nombre }}

                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary btn btn-success" >Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                categorias: []
            }
        },

        props: [
            'datosClientes'
        ],

        methods: {
            listarCategorias() {

                //return this.categorias;
                axios.get('./api/categoria')
                    .then(response => this.categorias = response.data)
                    .catch(error => {
                        console.log(error.message + ' editar-get: api/categoria');
                    })
                    .finally(
                        console.log(this.categorias)
                    );
            },
        },

        created() {
            console.log('componente creado edicion cliente');
            console.log(this.listarCategorias())
        },
    }
</script>
