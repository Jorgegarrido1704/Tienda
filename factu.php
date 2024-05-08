<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
require "app/conection.php";
date_default_timezone_set("America/Mexico_City");
$fechade = isset($_POST['de']) ? $_POST['de'] : "";
$fechaa = isset($_POST['a']) ? $_POST['a'] : "";
   
if ($fechade != "" && $fechaa != "") {
   // echo "De: " . $fechade . " a " . $fechaa;
    
    $fechade = strtotime(date("d-m-Y", strtotime($fechade)));
    $fechaa = strtotime(date("d-m-Y", strtotime($fechaa)));
    
  //  echo "<br>" .  $fechade . "<br>" .  $fechaa . "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>facturacion del mes</title>
</head>
<style>
    body{
        width: 100%;
        background-color: blanchedalmond;
    }
.title{
    font-size: xx-large;
    align-items: center;
    text-align: center;
}
.links{
    align-items: center;
    align-self: center;
    text-align: center;
    padding-top: 100px;
}
#btn{
    
    padding-right: 20px;
}
label{
    font: bold;
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
}
</style>
<body>
    <div><small><a href="principal.php"><button>Atras</button></a></small></div>
            <div align="center"><h1>Facturacion del mes</h1>
            <br>
        <form action="factu.php" method="POST">
            <label for="de">Buscar por fechas </label><input type="date" name="de" id="de" required>
            <label for="a">A</label> <input type="date" name="a" id="a" required>
            <input type="submit" name="buscar" id="buscar" value="buscar">
        </form>
        <br>
        </div>
    <table>
        <thead>
            <th><h2>Fecha</h2></th>
            <th><h2>Cantidad</h2></th>
            <th><h2>Producto</h2></th>
            <th>Cuenta</th>
            <th>Vendedor</th>
            <th><h2>Precio</h2></th>
        </thead>
        <tbody>
            <?php 
            $total=0;
            $venta = mysqli_query($con, "SELECT * FROM venta WHERE nulo=''");
                 while($row=mysqli_fetch_array($venta)){
                $fecha=$row['fecha'];
                $fechas=strtotime($fecha);
                $cantidad=$row['cantArt'];
                $art=$row['articulo'];
                $precio=$row['precio'];
                $cuenta=$row['cuenta'];
                $vendedor=$row['vendedor'];
                if($fechade!="" && $fechaa!="" and $fechas>=$fechade && $fechas<=$fechaa){
                $total=$total+($cantidad*$precio);
            ?>
            <tr>
                <td><?php echo $fecha;?></td>
                <td><?php echo $cantidad;?></td>
                <td><?php echo $art;?></td>
                <td><?php echo $cuenta;?></td>
                <td><?php echo $vendedor;?></td>
                <td><?php echo $precio;?></td>
            </tr>
            <?php }else if($fechade=="" && $fechaa==""){    $total=$total+($cantidad*$precio);
            ?>
            <tr>
                <td><?php echo $fecha;?></td>
                <td><?php echo $cantidad;?></td>
                <td><?php echo $art;?></td>
                <td><?php echo $cuenta;?></td>
                <td><?php echo $vendedor;?></td>
                <td><?php echo $precio;?></td>
            </tr>
        <?php }
        
        } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL: </td>
            <td><b><?php echo $total;?></b></td>
            </tr>
        </tbody>
    </table>

</body>

</html>
<?php } ?>