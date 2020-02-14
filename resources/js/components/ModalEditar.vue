<template>
    <div>
        <form @submit.prevent="editarCliente" method="POST">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header border-0">
                        <slot name="header">
                            default header
                        </slot>
                        <button type="button" @click="$emit('close')"  class="close" aria-label="Close">
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
                                       class="form-control rounded-0" type="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <span>Edad</span>
                                <input v-model:edad="cliente.edad"
                                       class="form-control rounded-0" type="number"  name="edad" min="0" max="100" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <span>Descripción</span>
                                <textarea v-model:descripcion="cliente.descripcion"
                                          class="form-control rounded-0" type="text" name="descripcion">
                                </textarea>
                                <input v-show="" type="text" v-model:idCliente="cliente.id">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label >Categoría</label>
                                <select class="form-control rounded-0" required>
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
                        <slot name="footer">
                            <button type="submit" class="btn btn-secondary btn btn-success" >Guardar</button>
                        </slot>
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
                        this.close(),
                        this.cambiarInformacion()
                    );
            },

            listarCliente() {
                this.$emit('listar-cliente')
            },

            cambiarInformacion() {
                this.$emit('cambiar-info')
            },
            close() {
                this.$emit('close')
            },

        }
    }
</script>

<style scoped>

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 500px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        margin: 20px 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
