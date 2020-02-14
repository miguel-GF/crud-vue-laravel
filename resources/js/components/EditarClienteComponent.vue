<template>
    <div>
        <form @submit.prevent="editarCliente" method="POST">
        <div class="container-fluid">
            <div class="modal fade modal-open" id="ModalEditarCliente" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0 p-lg-3">
                        <div class="modal-header border-0 tituloModalCliente">
                            <span>Editar cliente</span>
                            <button type="button" class="close"  @click="$emit('cerrar-editar')" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <span>Nombre</span>
                                    <input v-model:nombre="cliente.nombre_cliente"
                                        class="form-control rounded-0"  type="text" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Correo electrónico</span>
                                    <input v-model:email="cliente.email"
                                           class="form-control rounded-0" type="email" required>
                                </div>
                                <div class="col-md-6">
                                    <span>Edad</span>
                                    <input v-model:edad="cliente.edad"
                                        class="form-control rounded-0" type="number" min="0" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <span>Descripción</span>
                                    <textarea v-model:descripcion="cliente.descripcion"
                                        class="form-control rounded-0" type="text">
                                    </textarea>
                                    <input v-show="" type="text" v-model:idCliente="cliente.id">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Categoría</label>
                                    <select class="form-control rounded-0">
                                        <option disabled>Selecciona una categoría</option>
                                        <option v-model:categoria="cliente.id_categoria" selected >{{cliente.categoria}}</option>

                                        <option
                                            v-model:categoria="cliente.id_categoria"
                                            v-for="c in categorias"
                                            v-if="cliente.id_categoria!= c.cliente_categoria_id" >

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
            'cliente',
            'mostrarInformacion',
            'informacion'
        ],

        created() {
            console.log('componente creado edicion cliente');
            this.listarCategorias()

        },
        mounted() {
            console.log(this.cliente);
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
                    nombre: this.cliente.nombre_cliente,
                    edad: this.cliente.edad,
                    email: this.cliente.email,
                    categoria: this.cliente.id_categoria,
                    descripcion: this.cliente.descripcion,
                    idCliente: this.cliente.id
                })
                .catch(function (error) {
                    console.log(error)
                })
                .then(
                    this.listarCliente(),
                    this.cambiarInformacion(),
                    $('#ModalEditarCliente').modal('hide'),
                );
            },

            listarCliente() {
                this.$emit('listar-cliente')
            },

            cambiarInformacion() {
                this.$emit('cambiar-info')
            }

        }
    }
</script>
