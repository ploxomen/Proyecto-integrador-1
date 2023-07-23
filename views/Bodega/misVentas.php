<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="./../../Public/js/misVentas.js"></script>
    <link rel="stylesheet" href="./../../public/css/misVentas.css">
    <title>Mis ventas</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Mis ventas</h3>
        <div class="contenido-tabla bg-white p-3 mb-4">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Filtros</h4>
            </div>
            <form id="filtros" class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="txtFechaInicio">Fecha Inicio</label>
                    <input type="date" name="fechaInicio" id="txtFechaInicio" class="form-control form-control-sm" value="<?php echo date("Y-m-d",strtotime(date('Y-m-d')."- 30 days"))?>">
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="txtFechaFin">Fecha Fin</label>
                    <input type="date" name="fechaFin" id="txtFechaFin" class="form-control form-control-sm" value="<?php echo date('Y-m-d')?>">
                </div>
                <div class="col-12 col-lg-3">
                    <div class="d-flex" style="gap:5px;">
                        <button class="btn btn-sm btn-primary" id="btnAplicarFiltro" type="button" title="Aplicar filtros">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-login-access dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="nombre-usuario">Reportes</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="button" class="dropdown-item text-secondary" id="btnReporteDetalle" data-accion="pdf">
                                        <i class="far fa-file-pdf text-danger"></i>
                                        PDF - Detalle de venta
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item text-secondary" id="btnReporteDetalleExcel" data-accion="excel">
                                        <i class="far fa-file-excel text-success"></i>
                                        EXCEL - Detalle de venta
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de ventas</h4>
            </div>
            <table class="table table-sm table-bordered" id="misVentas">
                <thead>
                    <tr>
                        <th>N° Venta</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Celular</th>
                        <th>Dirección</th>
                        <th>N° Productos</th>
                        <th>Cantidad</th>
                        <th>Importe</th>
                        <th>I.G.V</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </main>
    <?php require_once 'modales/editarProducto.php'; ?>
</body>

</html>