
<div class="container-fluid">
    <div class="modal fade modal-open" id="ModalEditarCliente" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-0 p-lg-3">
            <div class="modal-header border-0 tituloModalCliente">
                <span>Editar cliente</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span>Nombre</span>
                        <input class="form-control rounded-0" name="nombre" type="text" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <span>Correo electrónico</span>
                        <input class="form-control rounded-0" type="email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <span>Edad</span>
                        <input class="form-control rounded-0" type="text"  name="edad" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <span>Descripción</span>
                        <textarea class="form-control rounded-0" type="text" name="descripcion">
                            </textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for=>Categoría</label>
                        <select class="form-control rounded-0">
                            <option selected disabled>Selecciona una categoría</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
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
