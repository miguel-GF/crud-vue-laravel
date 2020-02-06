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
            <tr>
                <td>2</td>
                <td>Miguel</td>
                <td>miguel@correo.com</td>
                <td>categoria</td>
                <td>30ujuuuu</td>
                <td>
                    <a href="">Editar</a>
                    |
                    <a href="">Borrar</a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>name</td>
                <td>name@correo.com</td>
                <td>categoria</td>
                <td>40</td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#ModalEditarCliente">Editar</a>
                    |
                    <a href="#">Borrar</a>
                </td>
            </tr>
            <tr>
                <td v-for="cliente in clientes" :key="cliente.id">
                    {{ cliente.nombre }}                
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
            clientes: []
        }
    },
    created() {
        axios.get('api/cliente')
        .then(response => this.clientes = response.data);
    }
}
</script>