import axios from 'axios';
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('agregar-cliente-component', require('./components/AgregarClienteComponent.vue').default);
Vue.component('editar-cliente-component', require('./components/EditarClienteComponent.vue').default);
Vue.component('modal-agregar', require('./components/ModalAgregar.vue').default);
Vue.component('modal-editar', require('./components/ModalEditar.vue').default);

const app = new Vue({

    el: '#app',
    data: {
        clientes: [],
        clienteEditar: {},
        mostrarAgregar: false,
        mostrarEdicion: false,
        mostrarInformacion: false,
        informacion: '',
        busqueda: '',
        alert: '',
        showModal: false,
        showModalEditar: false,
        showModalImagen: false,
        imagen: 'logotipo.jpg'
    },

    created() {
        console.log(this.listarClientes())
    },

    mounted() {
        console.log('mostrar imagen: '+this.mostrarImagen())
    },
    methods: {
        listarClientes() {
            axios.get('./api/listarClientes')
                .then(response => this.clientes = response.data)
                .catch(error => {
                    console.log(error.message + ' get: api/cliente');
                })
                .finally(
                    console.log(this.clientes)
                );
        },
        /*editarCliente(cliente){
          console.log('cargando cliente!');
          console.log(cliente);
          this.clienteEditar = cliente;
          this.mostrarEdicion = true;
          this.$nextTick(() => {
              $('#ModalEditarCliente').modal('show');
          });

        },
        cerrarEditar(){
            $('#ModalEditarCliente').modal('hide');
            this.$nextTick(() => {
                this.mostrarEdicion = false;
            });
        },*/
        borrarCliente(id) {
            axios.post('./api/borrarCliente', {
                id
            }).then(res => {
                this.listarClientes()
                this.informacion = 'Cliente Borrado - STATUS PASO A 300',
                this.mostrarInformacion = !this.mostrarInformacion
            })
            .catch(function (error) {
                console.log(error)
            })
            .finally(

                setTimeout(() => {
                    this.informacion = '',
                    this.mostrarInformacion = !this.mostrarInformacion
                },3000)
            );
        },
        busquedaClientes(busqueda) {

            axios.get('./api/buscarClientes', {
                params: {
                    busqueda
                }
            })
                .then(
                    response => this.clientes = response.data
                )
                .catch(error => {
                    console.log(error.message + ' get: api/busquedaClientes');
                });


        },
        cambiarInformacion() {
            this.informacion = 'Cliente ACTUALIZADO',
            this.mostrarInformacion = !this.mostrarInformacion,

            setTimeout(() => {
                this.informacion = '',
                    this.mostrarInformacion = !this.mostrarInformacion
            },3000)
        },
        cambiarInformacionAgregar(error) {
            this.informacion = error,
                this.mostrarInformacion = !this.mostrarInformacion,

                setTimeout(() => {
                    this.informacion = '',
                        this.mostrarInformacion = !this.mostrarInformacion
                },3000)
        },

        cambioImagen() {
            this.imagen = event.target.files[0];
        },
        getImage(event){

            var formData = new FormData();
            formData.append("imagenNueva", this.imagen);

            axios.post('./api/cambiarImagen', formData)
                .then(
                    response => this.imagen = response.data
                )
                .catch(error => {
                    console.log(error.message );
                })
                .finally(
                    this.close()
                );
        },
        mostrarImagen() {
            axios.get('./api/mostrarImagen')
                .then(response => this.imagen = response.data)
                .catch(error => {
                    console.log(error.message + ' error al mostrar imagen');
                });
        },

        toggleModal () {
            this.showModal = !this.showModal
        },
        toggleModalEdit (cliente) {
            this.showModalEditar = !this.showModalEditar;
            this.clienteEditar = cliente;
        },
        toggleModalImagen () {
            this.showModalImagen = !this.showModalImagen
        },
        close() {
            this.showModalImagen = false
        },
        updateColor(alert) {
            this.alert = alert;
            console.log(this.alert);
        }

    }
});
