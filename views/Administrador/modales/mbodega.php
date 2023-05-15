<div class="modal fade" id="bodegaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Bodega</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" id="frmBodega">
                    <div class="col-md-6 col-12">
                        <label for="validationCustom01" class="form-label">RUC</label>
                        <input type="text" name="ruc" class="form-control" id="validationCustom01">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="validationCustom02" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="validationCustom02" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>

                    </div>
                    <div class="col-12">
                        <label for="validationCustomUsername" class="form-label">Correo</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="correo" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="validationCustom03" class="form-label">Direccion</label>
                        <input type="text" name="direccion" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="validationCustom05" class="form-label">Localización</label>
                        <input type="text" name="localizacion" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="validationCustom03" class="form-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control" id="validationCustom03">
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="validationCustom03" class="form-label">Celular</label>
                        <input type="text" name="celular" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="validationCustom05" class="form-label">DNI Propietario</label>
                        <input type="text" name="dni_propietario" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="validationCustom05" class="form-label">Nombre Propietario</label>
                        <input type="text" name="nombre_propietario" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                            <label class="form-check-label" for="invalidCheck">
                                Estoy de acurdo con las condiciones
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="btnSubmitFrmBodega" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnModalBodega">Agregar</button>
            </div>
        </div>
    </div>
</div>