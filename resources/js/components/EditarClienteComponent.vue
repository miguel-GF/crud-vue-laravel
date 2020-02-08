<template>
    <div>
        <form @submit.prevent="editarCliente" method="POST">
        <div class="container-fluid">
            <div class="modal fade modal-open" :id="'ModalEditarCliente'+datosClientes.id" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <input v-model:nombre="datosClientes.nombre_cliente"
                                        class="form-control rounded-0"  type="text" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Correo electrónico</span>
                                    <input v-model:email="datosClientes.email"
                                           class="form-control rounded-0" type="email" required>
                                </div>
                                <div class="col-md-6">
                                    <span>Edad</span>
                                    <input v-model:edad="datosClientes.edad"
                                        class="form-control rounded-0" type="number" min="0" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <span>Descripción</span>
                                    <textarea v-model:descripcion="datosClientes.descripcion"
                                        class="form-control rounded-0" type="text">
                                    </textarea>
                                    <input v-show="" type="text" v-model:idCliente="datosClientes.id">
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
                            <button class="btn btn-secondary btn btn-success" >Guardar</button>
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
        data() {
            return {
                categorias: [],
                errors: [],
                edad: '',
                email: '',
                categoria: '',
                descripcion: '',
                nombre: '',
                idCliente: ''
            }
        },

        props: [
            'datosClientes'
        ],

        created() {
            console.log('componente creado edicion cliente');
            console.log(this.listarCategorias())

        },

        methods: {
            listarCategorias() {
                //return this.categorias;
                axios.get('./api/listarCategorias')
                    .then(response => this.categorias = response.data)
                    .catch(error => {
                        console.log(error.message + ' componenteeditar-get: api/categoria');
                    })
                    .finally(
                        console.log(this.categorias)
                    );
            },

            editarCliente() {

                

                axios.post('./api/editarCliente', {
                    nombre: this.datosClientes.nombre_cliente,
                    edad: this.datosClientes.edad,
                    email: this.datosClientes.email,
                    categoria: this.datosClientes.id_categoria,
                    descripcion: this.datosClientes.descripcion,
                    idCliente: this.datosClientes.id
                })
                .catch(function (error) {
                    console.log(error)
                });
            },


        }
    }
</script>
