import axios from 'axios';
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('agregar-cliente-component', require('./components/AgregarClienteComponent.vue').default);
Vue.component('editar-cliente-component', require('./components/EditarClienteComponent.vue').default);
Vue.component('cambiar-imagen-component', require('./components/CambiarImagenComponent.vue').default);

const app = new Vue({

    el: '#app',
    data() {
        return {
            //elementVisible: true,
            datosCliente: []
        }
    },

   created() {
       //setTimeout(() => this.elementVisible = false, 3000)

    },

    methods: {

    }
});
