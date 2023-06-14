<div class="modal fade" id="editarStock" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Stock - Precio venta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="frmEditarStock" class="row">
            <div class="mb-2 col-12">
                <label for="nombreProducto" class="form-label">Producto</label>
                <input type="text" readonly name="nombre" class="form-control form-control-sm" id="nombreProducto" required>
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-4">
                <label for="txtPrecioVenta" class="form-label">Precio venta</label>
                <input type="number" name="precioVenta" min="0.00" step="0.01" class="form-control form-control-sm" id="txtPrecioVenta" required>
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-4">
                <label for="txtDescuento" class="form-label">Descuento</label>
                <input type="number" require value="0.00" min="0.00" name="descuento" step="0.01" class="form-control form-control-sm" id="txtDescuento">
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-4">
                <label for="txtStock" class="form-label">Stock</label>
                <input type="number" name="stock" min="0.01" step="0.01" class="form-control form-control-sm" id="txtStock" required>
            </div>
            <input type="submit" hidden id="frmEnviar">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnActualiarStock">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>