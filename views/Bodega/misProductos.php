<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="./../../Public/js/misProductos.js"></script>
    <link rel="stylesheet" href="./../../public/css/agregarProducto.css">
    <title>Mis productos</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Mis productos</h3>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de productos</h4>
            </div>
            <table class="table table-sm table-bordered" id="misProductos">
                <thead class="text-center">
                    <tr>
                        <th>N°</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Categorías</th>
                        <th>Marca</th>
                        <th>Precio compra</th>
                        <th>Precio venta</th>
                        <th>Stock mínimo</th>
                        <th>Stock Actual</th>
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