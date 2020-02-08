<template>
<div>
<form method="POST" @submit.prevent="agregarCliente">
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
                            <input v-model="nombre"
                                class="form-control rounded-0" name="nombre" type="text">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Correo electrónico</span>
                            <input v-model="email"
                                class="form-control rounded-0" type="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <span>Edad</span>
                            <input v-model="edad"
                                class="form-control rounded-0" type="number"  name="edad" min="0">
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
                            <select v-model="categoria" placeholder="hello mike"
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
                    <p v-if="errors.length">
                        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>
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
        data () {
            return {
                nombre: '',
                edad: '',
                email: '',
                categoria: '',
                descripcion: '',
                errors: [],
                categorias: []
            }
        },

        created() {
            console.log('componente creado');
            console.log(this.listarCategorias())
        },
        methods: {
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
                if(!this.checkFormAgregarCl())
                    return false;

                axios.post('./api/agregarCliente', {
                        nombre: this.nombre,
                        edad: this.edad,
                        email: this.email,
                        categoria: this.categoria,
                        descripcion: this.descripcion,
                })
                .catch(function (error) {
                    console.log(error)
                });

            },

            checkFormAgregarCl: function () {

                this.errors = [];

                if (!this.nombre) {
                    this.errors.push('El Nombre es obligatorio.');
                }
                if (!this.edad) {
                    this.errors.push('La Edad es obligatoria.');
                }
                if (!this.email) {
                    this.errors.push('El Correo Electrónico es obligatorio.');
                } else if (!this.validEmail(this.email)) {
                    this.errors.push('El Correo Electrónico debe ser válido.');
                }
                if (!this.categoria) {
                    this.errors.push('La Categoria es obligatorio.');
                }
                if (!this.errors.length) {
                    return true;
                }
            },

            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        }
    }
</script>
