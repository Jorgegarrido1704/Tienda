<?php require "../app/conection.php";
date_default_timezone_set("America/Mexico_city");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonificacion</title>
</head>
<style>  body{
        width: 100%;
        background-color: blanchedalmond;
    }
    table{
    border: 2px lightslategray solid;
    width: 100%;
}
th{
    border: 1px lightblue solid;
}
td{
    align-items: center;
    text-align: center;
    border-bottom: 1px lightblue solid;
}</style>
<body>
    <div><small><a href="../principal.php"><button>Home</button></a></small></div>
    <div align="center">
        <h1>Bonificaciones</h1>
        <table>
            <thead>
                <th>Cuenta</th>
                <th>Cliente</th>
                <th>Fecha de compra</th>
                <th>Fecha de vencimiento</th>
                <th>Saldo </th>
                <th>Ver Bonificacion</th>
            </thead>
            <tbody>
                <?php $cuentas=mysqli_query($con,"SELECT * FROM historico WHERE saldo>0 ORDER BY cuenta ASC");
                while($row=mysqli_fetch_array($cuentas)){
                    $id=$row['id'];
                    $cuenta=$row['cuenta'];
                    $cliente=$row['cliente'];
                    $fecha=$row['fecha'];
                    $saldo=$row['saldo'];
                    $plazo=$row['meses'];
                    $fechas=strtotime($fecha);
                    $vencimientoTimestamp = strtotime("+$plazo months", $fechas);
                    $vencido=date("d-m-y",($vencimientoTimestamp))?>
                    <tr>
                        <td><?php echo $cuenta;?></td>
                        <td><?php echo $cliente; ?></td>
                        <td><?php echo $fecha;?></td>
                        <td><?php echo $vencido;?></td>
                        <td><?php echo $saldo;?></td>
                        <td><form action="boni.php" method="POST">
                            <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta;?>">
                            <input type="submit" name="enviar" id="enviar" value="Ver Bonificacion" >
                        </form></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
