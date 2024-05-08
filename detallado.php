<?php 
session_start();
require "app/conection.php";
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$art=isset($_POST['art'])?$_POST['art']:"";
$cli=isset($_POST['client'])?$_POST['client']:"";
$abono=isset($_POST['abo'])?$_POST['abo']:"";
$resto=isset($_POST['rest'])?$_POST['rest']:"";
$recibo=isset($_POST['recibo'])?$_POST['recibo']:"";

date_default_timezone_set("America/Mexico_City");
$today=date("d-m-Y");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abono</title>
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
</head>
<body>
<div><small><a href="pagadas.php"><button>Atras</button></a></small></div>
    <div align="center"><h1>Formato de abono</h1></div>
<table>
    
    <th>Cliente</th>
    <th>Cuenta</th>
    <th>Articulo</th>
    <th>Abono semanal</th>
    <th>Precio</th>
    <th>Enganche</th>
    
    </thead>
    <tbody>
        <?php 
        if($cuenta!=""){
        $sqy=mysqli_query($con,"SELECT * FROM venta WHERE cuenta='$cuenta'");}else{
            header("location:principal.php");
        }while($row=mysqli_fetch_array($sqy)){
            $cli=$row['cliente'];
            $cuenta=$row['cuenta'];
            $art=$row['articulo'];
            $saldo=$row['precio'];
            $eng=$row['enganche'];
            $semanal=$row['semanal'];
        }
        ?>
        <tr>
          
            <td><?php echo $cli;?></td>
            <td><?php echo $cuenta;?></td>
           <td><?php echo $art;?></td>
                <td><?php echo $semanal;?></td>
            <td><?php echo $saldo;?></td>
            <td><?php echo $eng;?></td>
           

        </tr>
    </tbody>
</table>



    <div align="center"><h1>Historial de abonos</h1></div>
    <div>
        <table>
            <thead>
                <th>Fecha</th>
                <th>Cuenta</th>
                <th>Cliente</th>
                <th>Abono</th> 
                <th>No° de recibo</th>  
            </thead>
            <tbody>
                <?php 
                $qry=mysqli_query($con,"SELECT * FROM abonos WHERE cuenta='$cuenta' and client='$cli'");
                while($rowab=mysqli_fetch_array($qry)){
                    $id=$rowab['id'];
                    $cuenta=$rowab['cuenta'];
                    $client=$rowab['client'];
                    $fechaab=$rowab['fechab'];
                    $abonos=$rowab['abono'];
                    $recibo=$rowab['NoRec']
                ?>
                <tr>
                    <td><?php echo $fechaab;?></td>
                    <td><?php echo $client;?></td>
                    <td><?php echo $cuenta;?></td>
                    <td><?php echo $abonos;?></td>
                    <td><?php echo $recibo;?></td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php } ?>