<?php
use Controllers\Login;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/Login.php';

$cLogin = new Login;
switch ($_POST['accion']) {
    case 'autenticar':
        $response = $cLogin->autenticarUsuario($_POST['correo'],$_POST['contrasena']);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
    case 'crear-cuenta':
        $response = $cLogin->crearCuenta($_POST['correo'], $_POST['contrasena'],$_POST['nombres'], $_POST['apellidos'], $_POST['celular'],$_POST['direccion']);
        echo json_encode($response, JSON_FORCE_OBJECT);
    break;
}
