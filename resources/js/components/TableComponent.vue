<template>
    <div>
    <div class="container-fluid listado">
    <table class="table table-striped">
        <thead>
            <tr class="table-active">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>CORREO ELECTRÓNICO</th>
                <th>CATEGORIA</th>
                <th>EDAD</th>
                <th>OPCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr></tr>
            <tr v-for="cliente in clientes" :key="cliente.cliente_id">
                <td >
                    {{ cliente.cliente_id }}
                </td>
                <td >
                    {{ cliente.nombre_cliente }}
                </td>
                <td >
                    {{ cliente.email }}
                </td>
                <td >
                    {{ cliente.categoria }}
                </td>
                <td >
                    {{ cliente.edad }}
                </td>
                <td>
                    <editar-cliente-component v-bind:datosClientes="cliente"></editar-cliente-component>
                    <a href="'#'" data-toggle="modal" :data-target="'#ModalEditarCliente'+cliente.edad">Editar</a>
                    |
                    <a href="#" @click.prevent="borrarCliente">Borrar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            clientes: [],
            id: ''
        }
    },

    props: [
        'datosClientes'
    ],

    created() {
        console.log('componente table creado')
        console.log(this.listarClientes())
    },
    methods: {
        listarClientes() {
            axios.get('./api/cliente')
                .then(response => this.clientes = response.data)
                .catch(error => {
                    console.log(error.message + ' get: api/cliente');
                })
                .finally(
                    console.log(this.clientes)
                );
        },
        borrarCliente() {
            alert(' para actualizar ');
            axios.post('./api/cliente/id')
                .then(console.log('ES MI ID: '))
                .catch(function (error) {
                    console.log(error + ' PUT: ACTUALIZAR CLIENTE')
                });

        }
    }
}
</script>
