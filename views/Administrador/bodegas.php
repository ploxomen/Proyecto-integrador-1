<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDatatable.php"); ?>
    <script src="<?php echo URL . '/Public/js/bodegas.js' ?>"></script>
    <title>Categoría de productos</title>
</head>

<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboard.php") ?>
    <main class="contenido-pagina">
        <h3 class="text-center titulo-principal-modulo mb-4">Bodegas</h3>
        <div class="mb-3 text-end">
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bodegaModal">
                <i class="fa-solid fa-plus"></i>
                Agregar Bodega
            </button>
        </div>
        <div class="contenido-tabla bg-white p-3">
            <div class="py-3">
                <h4 class="titulo-principal-modulo"><i class="fa-solid fa-caret-right"></i> Lista de bodegas</h4>
            </div>
            <table class="table table-sm table-bordered" id="misBodegas">
                <thead class="text-center">
                    <tr>
                        <th>N°</th>
                        <th>RUC</th>
                        <th>Bodega</th>
                        <th>Direccion</th>
                        <th>Propietario</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </main>
    <?php require_once 'modales/mbodega.php'; ?>

</body>

</html>