<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
require "../app/conection.php"; 
date_default_timezone_set("America/Mexico_City");
$fechade=isset($_POST['de'])?$_POST['de']:"";
$fechaa=isset($_POST['a'])? $_POST['a']:"";
   
if ($fechade != "" && $fechaa != "") {
   // echo "De: " . $fechade . " a " . $fechaa;
    
    
    
    $fechade =strtotime( date("d-m-Y", strtotime($fechade)));
  //  $fechade=strtotime($fechade);
    $fechaa =strtotime( date("d-m-Y",strtotime($fechaa)));
    //$fechaa=strtotime($fechaa);
    
   // echo "<br>" . $fechade . "<br>" . $fechaa . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por empleado</title>
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
}label{
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
    
<div><small><a href="../principal.php"><button>Atras</button></a></small></div>

<div align="center"><h1>Ventas por empleado</h1>
<a href="comiciones.php"><button>Comiciones por Vendero y Promotor</button></a>
<br><br>
<form action="ventasPorEmpleado.php" method="POST">
        <label for="de">Buscar por fechas </label><input type="date" name="de" id="de" require>
        <label for="a">A</label> <input type="date" name="a" id="a" require>
        <input type="submit" name="buscar" id="buscar" value="buscar">
    </form><br><br>
</div>
<table>
    <thead>
        <th>Fecha de venta</th>
        <th>Promotor</th>
        <th>Vendedor</th>
        <th>Cuenta</th>
        <th>precio de venta</th>
    </thead>
    <tbody>
        <?php 
        $tt=0;
        $sqy=mysqli_query($con,"SELECT * FROM historico");
        While($row=mysqli_fetch_array($sqy)){
            $vendedor=$row['vendedor'];
            $date=$row['fecha'];
            $dates=strtotime($date);
            $cuenta=$row['cuenta'];
            $precio=$row['precio'];
            $promo=$row['promotor'];
            //echo $date.'<br>';
            if($fechade!="" && $fechaa!="" and $dates>=$fechade && $dates<=$fechaa){
            $tt=$precio+$tt;
            ?>
                <tr>
                    <td><?php echo $date;?></td>
                    <td><?php echo $promo; ?></td>
                    <td><?php echo $vendedor;?></td>
                    <td><?php echo $cuenta;?></td>
                    <td><?php echo $precio;?></td>
                </tr>
            <?php       } else if($fechade=="" && $fechaa=="")   { $tt=$precio+$tt;
            ?>
                <tr>
                    <td><?php echo $date;?></td>
                    <td><?php echo $promo; ?></td>
                    <td><?php echo $vendedor;?></td>
                    <td><?php echo $cuenta;?></td>
                    <td><?php echo $precio;?></td>
                </tr>
            <?php       }}    ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total: </td>
                <td><?php echo $tt;?></td>
            </tr>
    </tbody>
</table>

</body>
</html>

<?php } ?>