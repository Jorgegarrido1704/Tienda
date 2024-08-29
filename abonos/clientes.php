<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
require "../app/conection.php";

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
img{
    padding-right: 50px;
}
</style>
<body>
    <div><small><a href="../principal.php"><button>Atras</button></a></small></div>
    <!--<div align="right"><img src="pdf.jpg" alt="registro pdf" width="50px;" height="80px; "></div>-->
    <div align="center">
        <div><form action="clientes.php" method="POST">
            <label for="busnom">Buscar por nombre: </label><input type="text" name="name" id="name">
    <label for="cuenta">Buscar por Cuenta: </label><input type="text" name="cuenta" id="cuenta"> 
<input type="submit" name="enviar" id="enviar" value="Buscar "></form></div>
    <br><br>    
    <h1>Lista de clientes</h1></div>
<div class="table">
<table>
<thead>
    <th>Cuenta</th>
    <th>Nombre</th>
   
    <th>Saldo</th>
    <th>Fecha de vencimiento </th>
    <th>Edit</th>
<th>Abonar</th>
</thead>
    <tbody>
        <?php 
        if($name!="" and $cuenta!="" ){
            $qry=mysqli_query($con,"SELECT * FROM historico WHERE cliente LIKE'%%$name%%' and cuenta LIKE'%%$cuenta%%'  ORDER BY fecha ASC ");}
            else if($name!=""){
                $qry=mysqli_query($con,"SELECT * FROM historico WHERE   cliente LIKE '%%$name%%'  ORDER BY fecha ASC ");}
                else if($cuenta!=""){
                    $qry=mysqli_query($con,"SELECT * FROM historico WHERE cuenta LIKe'%%$cuenta%%'  ORDER BY fecha ASC  ");}
                    else{
        $qry=mysqli_query($con,"SELECT * FROM historico WHERE saldo>'0' and nulo!='Cancelada' ORDER BY cuenta ASC ");}
        while($row=mysqli_fetch_array($qry)){
            $cuenta=$row['cuenta'];
            $client=$row['cliente'];
            $art=$row['articulo'];
            $saldo=$row['saldo'];
            $fecha=$row['fecha'];
            $fechas = strtotime($fecha); 
            $plazo=$row['meses'];
$vencimientoTimestamp = strtotime("+$plazo months", $fechas);
$vencimiento = date("d-m-y", $vencimientoTimestamp);

        ?>
        <tr>
        <td><form action="../impresion.php" method="POST">
                <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta; ?>">
                <input type="submit" name="enviar" id="enviar" value="<?php echo $cuenta; ?>">
            </form><?php //echo $cuenta;?></a></td>
        <td><?php echo $client;?></td>
        <td><?php echo $saldo;?></td>
        <td><?php echo $vencimiento;?></td>
       <td><form action="editclient.php" method="POST">
                <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta; ?>">
                <input type="submit" name="enviar" id="enviar" value="editar">
            </form></td>
     
            <td><form action="abono.php" method="POST">
                <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta; ?>">
                <input type="submit" name="enviar" id="enviar" value="Abonar">
            </form></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

</div>
</body>
</html>
<?php } ?>