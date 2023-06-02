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
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de ventas</h4>
            </div>
            <table class="table table-sm table-bordered" id="misVentas">
                <thead>
                    <tr>
                        <th>N° Venta</th>
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