<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Añadimos los archivos requeridos como css y js agrupados en un php -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="./../../Public/js/agregarVenta.js"></script>
    <link rel="stylesheet" href="./../../public/css/agregarProducto.css">
    <title>Agregar productos</title>
</head>

<body>
    <!-- Llamamos nuestro dashbord ya creado -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <div class="container">
            <div class="p-4 bg-white m-auto rounded" style="max-width: 700px;">
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
                        <div class="pb-3">
                            <h3 class="text-center titulo-principal-modulo">Elegir cliente</h3>
                        </div>
                        <form id="primerFormulario" class="row mb-3">
                            <div class="mb-2 col-12">
                                <label for="cbClientes" class="form-label">Cliente</label>
                                <select name="cliente" id="cbClientes" required>
                                    <option value=""></option>
                                    <!-- Recorremos los clientes para almacenarlos en un option -->
                                    <?php
                                    foreach ($listaClientes as $cliente) {
                                        echo "<option value='" . $cliente['id'] . "'>" . $cliente['nombres'] . ' ' . $cliente['apellidos'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-2 col-12">
                                <label for="txtDireccion" class="form-label">Direccion</label>
                                <input type="text" name="direccion" class="form-control form-control-sm" id="txtDireccion" required>
                            </div>
                            <div class="mb-2 col-12 col-lg-6">
                                <label for="txtCelular" class="form-label">Celular</label>
                                <input type="tel" name="celular" class="form-control form-control-sm" id="txtCelular" required>
                            </div>
                            <input type="submit" id="formFrimero" hidden>
                        </form>
                        <div class="text-center">
                            <button class="btn btn-primary" id="btnSiguientePrimero"><i class="fa-regular fa-hand-point-right"></i> Siguiente</button>
                        </div>
                    </div>
                    <div class="formulario" id="boxFormularioOcul2" hidden>
                        <div style="min-height: 258px;">
                            <div class="pb-3">
                                <h3 class="text-center titulo-principal-modulo">Agregar carrito</h3>
                            </div>
                            <div class="mb-2">
                                <label for="cbProductos" class="form-label">Productos</label>
                                <select id="cbProductos">
                                    <option value=""></option>
                                    <!-- Recorremos los clientes para almacenarlos en un option -->
                                    <?php
                                        foreach ($listaProductos as $producto) {
                                            echo "<option value='" . $producto['id'] . "'>" . $producto['nombre'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="py-2">
                                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Productos seleccionados</h4>
                            </div>
                            <form id="segundoFormulario" class="row mb-5">
                                <table class="table table-sm table-bordered text-center" style="font-size: 0.8rem;">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Costo S/</th>
                                            <th>Importe</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="llenarProducto">
                                        <tr>
                                            <td colspan="6" class="text-center">Carrito vacío</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Subtotal</th>
                                            <th colspan="2" id="txtSubtotal">S/ 0.00</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-end">I.G.V</th>
                                            <th colspan="2" id="txtIgv">S/ 0.00</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-end">Total</th>
                                            <th colspan="2" id="txtTotal">S/ 0.00</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
                            <div class="pb-3">
                                <h3 class="text-center titulo-principal-modulo">Finalizar compra</h3>
                            </div>
                            <form id="tercerFormulario" class="row mb-5">
                                <div class="mb-2 col-12">
                                    <strong>Cliente: </strong>
                                    <span id="txtCopiaCliente"></span>
                                </div>
                                <div class="mb-2 col-12">
                                    <strong>Dirección: </strong>
                                    <span id="txtCopiaDireccion"></span>
                                </div>
                                <div class="mb-2 col-12 col-lg-6">
                                    <strong>Celular: </strong>
                                    <span id="txtCopiaCelular"></span>
                                </div>
                                <div class="mb-2 col-12">
                                    <b>Total productos: </b>
                                    <strong id="infoCostoProducto"></strong>
                                </div>
                                <div class="mb-2 col-12">
                                    <b>Envío: S/ </b>
                                    <strong>10.00</strong>
                                </div>
                                <div class="mb-2 col-12">
                                    <b>Total a pagar: </b>
                                    <strong id="cantidadFinal" class="text-danger"></strong>
                                </div>
                                <div class="form-check my-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                                    <label class="form-check-label" for="flexRadioCheckedDisabled">
                                        Pago contra entrega
                                    </label>
                                </div>
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