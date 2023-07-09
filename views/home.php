<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/helpers/headerDashboard.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo $data['rol'] == 'rol_bodega' ? URL . '/Public/js/dashboardBodega.js' : URL .'/Public/js/dashboardAdministrador.js' ?>"></script>
    <link rel="stylesheet" href="<?php echo URL . '/Public/css/printDashboard.css'?>">
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
        <?php
            if ($data['rol'] == 'rol_bodega') {
                require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Bodega/dashboard.php");
            } else if ($data['rol'] == 'rol_administrador') {
                require_once($_SERVER['DOCUMENT_ROOT'] . "/Views/Administrador/dashboard.php");
            }
        ?>
    </main>
</body>

</html>