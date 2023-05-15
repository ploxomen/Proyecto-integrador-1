<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Añadimos los archivos requeridos como css y js agrupados en un php -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="./../../Public/js/agregarProducto.js"></script>
    <link rel="stylesheet" href="./../../public/css/agregarProducto.css">
    <title>Agregar productos</title>
</head>

<body>
    <!-- Llamamos nuestro dashbord ya creado -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <div class="container">
            <div class="p-4 bg-white m-auto rounded" style="max-width: 700px;">
                <div class="pt-3">
                    <h3 class="text-center titulo-principal-modulo">Agregar producto</h3>
                </div>
                <div class="pasos pt-3 pb-4">
                    <div class="paso" id="btnPaso1" style="background-color: var(--color-principal);color:#fff;">
                        <span>1</span>
                        <div class="regla" style="width: 0;"></div>
                    </div>
                    <div class="paso" id="btnPaso2">
                        <span>2</span>
                        <div class="regla" style="width: 0;"></div>
                    </div>
                    <div class="paso" id="btnPaso3">
                        <span>3</span>
                    </div>
                </div>
                <div class="formularios">
                    <div class="formulario" id="boxFormularioOcul1">
                        <form id="primerFormulario" class="row mb-3">
                            <!-- <div class="col-12 text-center">
                                <h4 class="titulo-principal my-4">Detalle</h4>
                            </div> -->
                            <div class="mb-2 col-12">
                                <label for="nombreProducto" class="form-label">Producto</label>
                                <input type="text" name="nombre" class="form-control form-control-sm" id="nombreProducto" required>
                            </div>
                            <div class="mb-2 col-12">
                                <label for="descripcionProducto" class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control form-control-sm" id="descripcionProducto" rows="3"></textarea>
                            </div>
                            <!-- Recorremos las categorias que nos esta mandando nuestro controlador -->
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
                            <!-- Recorremos las marcas que nos esta mandando nuestro controlador -->
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
                            <input type="submit" id="formFrimero" hidden>
                        </form>
                        <div class="text-center">
                            <button class="btn btn-primary" id="btnSiguientePrimero"><i class="fa-regular fa-hand-point-right"></i> Siguiente</button>
                        </div>
                    </div>
                    <div class="formulario" id="boxFormularioOcul2" hidden>
                        <div style="min-height: 258px;">
                            <form id="segundoFormulario" class="row mb-5">
                                <div class="mb-2 col-12 col-md-6 col-lg-4">
                                    <label for="txtPrecioCompra" class="form-label">Precio compra (S/)</label>
                                    <input type="number" name="precioCompra" step="0.01" class="form-control form-control-sm" id="txtPrecioCompra" required>
                                </div>
                                <div class="mb-2 col-12 col-md-6 col-lg-4">
                                    <label for="txtPrecioVenta" class="form-label">Precio venta (S/)</label>
                                    <input type="number" name="precioVenta" step="0.01" class="form-control form-control-sm mayor-cero" data-valid="precio venta" id="txtPrecioVenta" required>
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
                                    <input type="number" name="stock" step="0.01" class="form-control form-control-sm mayor-cero" data-valid="stock" id="txtStock" required>
                                </div>
                                <input type="submit" id="formSegudo" hidden>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger" id="btnAtrasSegundo"><i class="fa-regular fa-hand-point-left"></i> Atras</button>
                            <button class="btn btn-primary" id="btnSiguienteSegundo"><i class="fa-regular fa-hand-point-right"></i> Siguiente</button>
                        </div>
                    </div>
                    <div class="formulario" id="boxFormularioOcul3" hidden>
                        <div style="min-height: 258px;">
                            <form id="tercerFormulario" class="row mb-5" enctype="multipart/form-data">
                                <!-- <div class="col-12 text-center">
                                    <h4 class="titulo-principal my-4">Imagen</h4>
                                </div> -->
                                <div class="mb-2 imagen-previa" id="boxImagenPrevia">
                                    <i class="fa-solid fa-image text-secondary"></i>
                                </div>
                                <img src="" alt="imagen previa" style="object-fit: contain;" width="120px" id="imagenPrevia" height="120px" hidden>
                                <div class="mb-2">
                                    <label for="formFile" class="form-label">Subir imagen</label>
                                    <input class="form-control" name="img" type="file" id="formFile" accept="image/*" required>
                                </div>
                                <input type="submit" id="formTercero" hidden>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger" id="btnAtrasTercero"><i class="fa-regular fa-hand-point-left"></i> Atras</button>
                            <button class="btn btn-secondary" id="btnCancelarTodo"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                            <button class="btn btn-primary" id="btnSiguienteFinalizar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>