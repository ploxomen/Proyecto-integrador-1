<?php
use Controllers\Bodega\Dashboard;
require_once '../../Controllers/Bodega/Dashboard.php';
$cDashboard = new Dashboard;
switch ($_POST['acciones']) {
    case 'solicitar-datos':
        $fechaIniAtras = date('Y-m-d',strtotime($_POST['fInicio'] . ' - 1 year'));
        $fechaFinAtras = date('Y-m-d',strtotime($_POST['fFin'] . ' - 1 year'));
        $response = [
            'productosVendidos' => $cDashboard->obtenerProductosMasVendidos($_POST['fInicio'],$_POST['fFin']),
            'rankingBodegas' => $cDashboard->obtenerRanking($_POST['fInicio'],$_POST['fFin']),
            'productosVendidosCategoria' => $cDashboard->obtenerProductosMasCategoria($_POST['fInicio'],$_POST['fFin']),
            'ventasRealizadas' => [
                'year1' => $cDashboard->obtenerVentas($_POST['fInicio'],$_POST['fFin']),
                'year2' => $cDashboard->obtenerVentas($fechaIniAtras,$fechaFinAtras)
            ]
        ];
        echo json_encode($response);
    break;
}

?>