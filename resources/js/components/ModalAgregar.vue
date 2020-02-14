<template>
    <div>
        <form method="POST" @submit.prevent="agregarCliente">
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
                                <input v-model="nombre"
                                       class="form-control rounded-0" name="nombre" required type="text">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <span>Correo electrónico</span>
                                <input v-model="email"
                                       class="form-control rounded-0" type="email" required name="email">
                            </div>
                            <div class="col-md-6">
                                <span>Edad</span>
                                <input v-model="edad"
                                       class="form-control rounded-0" type="number" required name="edad" min="0" max="100">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <span>Descripción</span>
                                <textarea v-model="descripcion"
                                          class="form-control rounded-0" type="text" name="descripcion">
                            </textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label >Categoría</label>
                                <select v-model="categoria" placeholder="hello mike" required
                                        class="form-control rounded-0" name="categoria">
                                    <option selected disabled>Selecciona una categoría</option>
                                    <option v-for="c in categorias" :value="c.cliente_categoria_id">
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
        data () {
            return {
                nombre: '',
                edad: '',
                email: '',
                categoria: '',
                descripcion: '',
                categorias: []
            }
        },

        created() {
            console.log('componente creado');
            this.listarCategorias()
        },

        methods: {
            close() {
             this.$emit('close')
            },
            listarCategorias() {

                //return this.categorias;
                axios.get('./api/listarCategorias')
                    .then(response => this.categorias = response.data)
                    .catch(error => {
                        console.log(error.message + ' get: api/categoria');
                    })
                    .finally(
                        console.log(this.categorias)
                    );
            },
            agregarCliente() {
                axios.post('./api/agregarCliente', {
                    nombre: this.nombre,
                    edad: this.edad,
                    email: this.email,
                    categoria: this.categoria,
                    descripcion: this.descripcion,
                })
                .then(res => {
                    if (res.data == true){
                        this.listarCliente(),
                        this.informacionAgregar('Cliente Agregado'),
                        this.color('alert-success')
                        this.close()
                    }
                    else {
                        this.listarCliente(),
                        this.informacionAgregar('Ocurrio un error, no se agrego cliente'),
                        this.color('alert-warning')
                        this.close()
                    }

                })
                .catch(function (error) {
                    console.log(error)
                })

            },
            color(alert) {
              this.$emit('cambio-color', alert)
            },
            informacionAgregar(error) {
                this.$emit('info-agregar',error)
            },
            listarCliente() {
                this.$emit('listar-cliente')
            }
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
