<div class="modal fade" id="editarProductoModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" class="row formularios">
            <div class="mb-2 col-12">
                <label for="nombreProducto" class="form-label">Producto</label>
                <input type="text" name="nombre" class="form-control form-control-sm" id="nombreProducto" required>
            </div>
            <div class="mb-2 col-12">
                <label for="descripcionProducto" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control form-control-sm" id="descripcionProducto" rows="3"></textarea>
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-8">
                <label for="cbCategorias" class="form-label">Categorías</label>
                <select name="categoria[]" id="cbCategorias" multiple required>
                    <option value=""></option>
                    <?php
                    foreach ($listaCategorias as $categoria) {
                        echo "<option value='" . $categoria['id'] . "'>" . $categoria['nombreCategoria'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-4">
                <label for="cbMarca" class="form-label">Marca</label>
                <select name="marca" class="form-select form-select-sm" id="cbMarca" required>
                    <option value=""></option>
                    <?php
                    foreach ($listaMarcas as $marca) {
                        echo "<option value='" . $marca['id'] . "'>" . $marca['nombreMarca'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2 col-12 col-md-6 col-lg-4">
                <label for="txtPrecioCompra" class="form-label">Precio compra (S/)</label>
                    <input type="number" name="precioCompra" step="0.01" class="form-control form-control-sm" id="txtPrecioCompra" required>
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="txtPrecioVenta" class="form-label">Precio venta (S/)</label>
                    <input type="number" name="precioVenta" step="0.01" class="form-control form-control-sm" id="txtPrecioVenta" required>
                </div>
                <div class="mb-2 col-12 col-md-6 col-lg-4">
                    <label for="txtPrecioVenta" class="form-label">Descuento (S/)</label>
                    <input type="number" name="descuento" step="0.01" class="form-control form-control-sm" id="txtPrecioVenta">
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="txtStockMinimo" class="form-label">Stock mínimo</label>
                    <input type="number" name="stockMinimo" step="0.01" value="0" class="form-control form-control-sm" id="txtStockMinimo">
                </div>
                <div class="mb-2 col-12 col-md-6">
                    <label for="txtStock" class="form-label">Stock</label>
                    <input type="number" name="stock" step="0.01" class="form-control form-control-sm" id="txtStock" required>
                </div>
                <div class="mb-2 imagen-previa" id="boxImagenPrevia">
                    <i class="fa-solid fa-image text-secondary"></i>
                </div>
                <img src="" alt="imagen previa" style="object-fit: contain;" width="120px" id="imagenPrevia" height="120px" hidden>
                <div class="mb-2">
                    <label for="formFile" class="form-label">Subir imagen</label>
                    <input class="form-control" name="img" type="file" id="formFile" accept="image/*" required>
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>