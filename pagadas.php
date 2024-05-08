<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
require "app/conection.php";

$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$name=isset($_POST['name'])?$_POST['name']:"";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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

    <div align="center">
        <div><form action="pagadas.php" method="POST">
            <label for="busnom">Buscar por nombre: </label><input type="text" name="name" id="name">
    <label for="cuenta">Buscar por Cuenta: </label><input type="number" name="cuenta" id="cuenta"> 
<input type="submit" name="enviar" id="enviar" value="Buscar "></form></div>
    <br><br>    
    <h1>Cuentas liquidads</h1></div>
<div class="table">
<table>
<thead>
    <th>Cuenta</th>
    <th>Nombre</th>
   
    <th>Precio</th>
    
    
<th>Detalles de cuenta</th>
</thead>
    <tbody>
        <?php 
        if($name!="" and $cuenta!="" ){
            $qry=mysqli_query($con,"SELECT * FROM historico WHERE cliente LIKE'%%$name%%' and cuenta LIKE'%%$cuenta%%'  AND saldo<='0'");}
            else if($name!=""){
                $qry=mysqli_query($con,"SELECT * FROM historico WHERE cliente LIKE '%%$name%%' AND saldo<='0' ");}
                else if($cuenta!=""){
                    $qry=mysqli_query($con,"SELECT * FROM historico WHERE cuenta LIKe'%%$cuenta%%' AND saldo<='0' ");}
                    else{
        $qry=mysqli_query($con,"SELECT * FROM historico WHERE saldo<='0' and nulo!='cancelada'");}
        while($row=mysqli_fetch_array($qry)){
            $cuenta=$row['cuenta'];
            $client=$row['cliente'];
            $art=$row['articulo'];
            $saldo=$row['precio'];
            $fecha=$row['fecha'];
            $fechas = strtotime($fecha); 
            $plazo=$row['meses'];
$vencimientoTimestamp = strtotime("+$plazo months", $fechas);
$vencimiento = date("d-m-Y", $vencimientoTimestamp);
if($saldo>0){
        ?>
        <tr>
        <td><?php echo $cuenta; ?></td>
        <td><?php echo $client;?></td>
        <td><?php echo $saldo;?></td>
        
      
     
            <td><form action="detallado.php" method="POST">
                <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta; ?>">
                <input type="submit" name="enviar" id="enviar" value="Detallado">
            </form></td>
    </tr>
    <?php }} ?>
    </tbody>
</table>

</div>
</body>
</html>
<?php } ?>