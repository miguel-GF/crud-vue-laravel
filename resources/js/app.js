import axios from 'axios';
require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('table-component', require('./components/TableComponent.vue').default);
Vue.component('agregar-cliente-component', require('./components/AgregarClienteComponent.vue').default);

const app = new Vue({

    el: '#app',
    data() {
        return {
            info: 'probando vue en laravel var info je',
            helados: [],
            path: 'api/'
        }
    },

    mounted() {
        //console.log('componente montado junto con var data info '+this.info+' mas NAV= '+this.mostrarNav)        
    },

    methods: {
        
    }
});
