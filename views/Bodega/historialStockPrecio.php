<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="./../../../Public/js/historialStockPv.js"></script>
    <!-- <link rel="stylesheet" href="./../../public/css/agregarProducto.css"> -->
    <title>Historial stock - precio venta</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Historial stock - precio venta</h3>
        <div class="contenido-tabla bg-white p-3 mb-4">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Mis productos</h4>
            </div>
            <div class="row">
                <div class="col-10 col-md-6 mb-2">
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
                <div class="col-2 col-md-6 mb-2">
                    <button type="button" class="btn btn-primary" title="Editar stock o precio venta" id="btnEditarCantidad">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
            
        </div>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Historial de modificaciones</h4>
            </div>
            <table class="table table-sm table-bordered" id="misHistoriales">
                <thead class="text-center">
                    <tr>
                        <th>N°</th>
                        <th>Fecha y Hora</th>
                        <th>Cantidad</th>
                        <th>Precio Venta</th>
                        <th>Descuento</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </main>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Views/Bodega/modales/editarStock.php'); ?>
</body>

</html>