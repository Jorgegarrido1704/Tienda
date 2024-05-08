<?php require "../app/conection.php";
date_default_timezone_set("America/Mexico_city");
$cuentaBoni=isset($_POST['cuenta'])?$_POST['cuenta']:"";
//echo $cuentaBoni;
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
    <div><small><a href="index.php"><button>Atras</button></a></small></div>
    <div align="center">
        <h1>Bonificaciones</h1>
        <table>
            <thead>
                <th>Cuenta</th>
                <th>Cliente</th>
                <th>Articulo</th>
                <th>Precio de Compra</th>
                <th>Precio con bonificacion</th>
                <th>Saldo al dia de hoy</th>
                <th>Pagando hoy su ahorro es </th>
                <th>Total a pagar</th>
                <th>Bonificar</th>
            </thead>
            <tbody>
                <?php $cuentas=mysqli_query($con,"SELECT * FROM venta WHERE saldo>0 and cuenta='$cuentaBoni'");
                while($row=mysqli_fetch_array($cuentas)){
                    $id=$row['id'];
                    $cuenta=$row['cuenta'];
                    $cliente=$row['cliente'];
                    $fecha=$row['fecha'];
                    $art=$row['articulo'];
                    $precio=$row['precio'];
                    $saldo=$row['saldo'];
                    $plazo=$row['meses'];
                   $montsini=(int)substr($fecha,3,2);
                   $yearini=(int)substr($fecha,8,2);
                   $months=(int)date("m");
                   $year=(int)date("y");

                 //echo $montsini."-".$yearini;
                  // echo "<br>".(int)$months."-".(int)$year; 
                   $compyear=$year-$yearini;
                   if($compyear==0){
                    $totalm=$months-$montsini;
                   }else if($compyear>0){
                    $totalm=(12-$montsini)+$months; }
                  //echo "<br>".$totalm."<br>";                    
                    if($totalm>0){
                    $inv=mysqli_query($con,"SELECT * FROM inventario WHERE product like '$art'");
                    while($rowart=mysqli_fetch_array($inv)){
                        $precioart=$rowart['precio'.$totalm];
                    //   echo $precioart;
                        $ahorro=$precio-$precioart;
                        $total=$saldo-$ahorro;
                    }                   ?>
                    <tr>
                        <td><?php echo $cuenta;?></td>
                        <td><?php echo $cliente; ?></td>
                        <td><?php echo $art;?></td>
                        <td><?php echo $precio;?></td>
                        <td><?php echo $precioart;?></td>
                        <td><?php echo $saldo;?></td>
                        <td><?php echo $ahorro;?></td>
                        <td><?php echo $total;?></td>
                        <td><form action="bonificar.php" method="POST">
                        <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta;?>">
                        <input type="hidden" name="cli" id="cli" value="<?php echo $cliente;?>">
                        <input type="hidden" name="art" id="art" value="<?php echo $art;?>">
                        <input type="hidden" name="precio" id="precio" value="<?php echo $precio;?>">
                        <input type="hidden" name="preart" id="preart" value="<?php echo $precioart;?>">
                        <input type="hidden" name="ahorro" id="ahorro" value="<?php echo $ahorro;?>">
                            <input type="submit" name="enviar" id="enviar" value="Bonificar" ></form></td>
                    </tr>
                    <?php } else{ ?>
                        <h1>Sus Articulos no alcanzan Bonificacion</h1>
                    <?php }                
                }?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script></script>
