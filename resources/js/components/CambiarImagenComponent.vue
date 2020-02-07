<template>
    <div>

        <div class="container-fluid">
            <div class="modal fade modal-open" id="ModalCambiarImagen" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0 p-lg-3">
                        <div class="modal-header border-0 tituloModalCliente">
                            <span>Editar imagen</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                        <div class="modal-body" >
                            <div class="row">
                                <div class="col">
                                    <label>Selecciona una imagen</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile"></label>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary btn btn-success" >Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {}
</script>
