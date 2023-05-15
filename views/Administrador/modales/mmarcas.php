<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Marca</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" id="frmMarcas">
                    <div class="col-12">
                        <label for="validationCustom01" class="form-label">Marca</label>
                        <input type="text" name="nombre_marcas" class="form-control" id="validationCustom01">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    
                    <input type="submit" id="btnSubmitFrmMarca" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnModalMarca">Agregar</button>
            </div>
        </div>
    </div>
</div>