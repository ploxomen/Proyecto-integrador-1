<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <title>Inicio</title>
</head>

<body>
    <?php
    if ($data['rol'] == 'rol_bodega') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboardBodega.php");
    } else if ($data['rol'] == 'rol_administrador') {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/dashboard.php");
    }
    ?>
    <main class="contenido-pagina">
        <section class="px-2 py-5 text-center">
            <img src="<?= URL . '/Public/img/intranet.png' ?>" alt="Imagen de intranet" width="300px" class="py-5">
            <h2 class="text-center">¡BIENVENIDO A LA INTRANET <b style="color:var(--color-principal)">BODEGAFAST</b>!</h2>
        </section>
    </main>
</body>

</html>