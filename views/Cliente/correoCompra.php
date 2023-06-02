<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo de compra</title>
</head>
<body>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        table{
            border-collapse: collapse;
        }
        .color-bodegafast{
            color: #F8B602;
        }
    </style>
    <h2 style="color: #F8B602;">¡GRACIAS POR COMPRAR EN BODEGAFAST!</h2>
    <p>
        Estimado(a) cliente <strong><?php echo $nombreCompleto; ?></strong> le enviamos este correo para notificarle que su compra se ha procesado con éxito con fecha y hora del 
        <strong><?php echo date('d/m/Y H:i'); ?></strong>, el pedido se hara entrega en la dirección <strong><?php echo $direccion; ?></strong> el monto total a pagar es de <strong>S/ <?php echo number_format($total,2); ?></strong>, incluye el envío.
    </p>
    <h3 style="color: #F8B602;">DETALLE DE LA COMPRA</h3>
    <table border="1">
        <thead>
            <tr>
                <th>N°</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Costo S/ </th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($productos as $k=>$p) {
                    echo "<tr>
                    <td>".($k+1)."</td>
                    <td>".$p['nombre']."</td>
                    <td>".$p['cantidad']."</td>
                    <td>S/ ".number_format($p['precio_venta'],2)."</td>
                    <td>S/ ".number_format($p['sub_total'],2)."</td>
                    </tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Subtotal</th>
                <th>S/ <?php echo number_format(floatval($subtotal - $igv),2); ?></th>
            </tr>
            <tr>
                <th colspan="4">I.G.V</th>
                <th>S/ <?php echo number_format($igv,2); ?></th>
            </tr>
            <tr>
                <th colspan="4">Envío</th>
                <th>S/ <?php echo number_format($envio,2); ?></th>
            </tr>
            <tr>
                <th colspan="4">Total</th>
                <th>S/ <?php echo number_format($total,2); ?></th>
            </tr>
        </tfoot>
    </table>
    <p>
        Para mayor información no olvide en contactarce con nosotros, estamos para ayudarlo.
    </p>
</body>
</html>