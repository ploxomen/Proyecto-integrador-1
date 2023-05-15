<div class="modal fade" id="categoriaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Categoría</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation" id="frmCategorias">
                    <div class="col-12">
                        <label for="idNombreCategoría" class="form-label">Categoría</label>
                        <input type="text" name="nombre_categoria" class="form-control" id="idNombreCategoría">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <input type="submit" id="btnSubmitFrmCategoria" hidden>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnModalCategoria">Agregar</button>
            </div>
        </div>
    </div>
</div>