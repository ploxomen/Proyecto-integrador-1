<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body>
<table border="1">
    <thead>
        <tr>
            <th>N° Venta</th>
            <th>Fecha Venta</th>
            <th style="width: 200px;">Cliente</th>
            <th>Método Pago</th>
            <th style="width: 300px;">Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $precio = 0;
            $cantidad = 0;
            $subtotal = 0;
            foreach ($ventas as $k=>$venta) {
                foreach ($venta['productos'] as $pk=>$p) {
                    $precio += $p['precio_venta'];
                    $cantidad += $p['cantidad'];
                    $subtotal += $p['subtotal'];
                    echo "<tr>
                    <td>".$venta['nroVenta']."</td>
                    <td>".$venta['fecha']."</td>
                    <td>".$venta['nombresCliente']."</td>
                    <td>".$venta['metodo_pago']."</td>
                    <td>".$p['nombre']."</td>
                    <td>S/".$p['precio_venta']."</td>
                    <td class='text-center'>".$p['cantidad']."</td>
                    <td>S/".$p['subtotal']."</td></tr>
                    ";
                }
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total</th>
            <th>S/<?php echo number_format($precio,2) ?></th>
            <th><?php echo $cantidad?></th>
            <th>S/<?php echo number_format($subtotal,2) ?></th>
        </tr>
    </tfoot>
</table>
</body>
</html>

