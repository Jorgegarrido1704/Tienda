<?php 
require "../app/conection.php";
date_default_timezone_set("America/mexico_City");
$today=date("d-m-Y");

$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$art=isset($_POST['art'])?$_POST['art']:"";
$cliente=isset($_POST['cli'])?$_POST['cli']:"";
$preart=isset($_POST['preart'])?$_POST['preart']:"";
$ahorro=isset($_POST['ahorro'])?$_POST['ahorro']:"";
$precio=isset($_POST['precio'])?$_POST['precio']:"";

echo $cuenta."--".$art."---".$precio."--".$preart."--".$ahorro;
if( $cuenta!="" and $art!="" and $precio!="" and $preart!="" and $ahorro!=""){
    $insertabon=mysqli_query($con,"INSERT INTO `bonif`( `cuenta`, `art`, `precioAnt`, `PrecioBon`, `ahorro`, `fecha`) VALUES ('$cuenta','$art','$precio','$preart','$ahorro','$today')");
   
    $selecthv=mysqli_query($con,"SELECT * FROM venta WHERE cuenta='$cuenta' and articulo='$art'  ORDER BY id DESC LIMIT 1");
    while($row=mysqli_fetch_array($selecthv)){
        $saldov=$row['saldo'];
        $id=$row['id'];
        $liquidacion=$saldov-$ahorro;
    }  
    $selecthv=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'   ");
    while($rowh=mysqli_fetch_array($selecthv)){
        $saldoh=$rowh['saldo'];
        $id=$rowh['id'];
        $newsaldo=$saldoh-$saldov;
    
    }
    $pagoBoni=mysqli_query($con,"INSERT INTO `abonos`( `cuenta`, `client`, `fechab`, `abono`, `NoRec`) VALUES ('$cuenta','$cliente','$today','$liquidacion','liquidacion con bonificacion')"); 
    $pagoBoni=mysqli_query($con,"INSERT INTO `abonos`( `cuenta`, `client`, `fechab`, `abono`, `NoRec`) VALUES ('$cuenta','$cliente','$today','$ahorro','Bonificacion')");
    $updsaldov=mysqli_query($con,"UPDATE venta SET saldo='0' WHERE articulo='$art' and cuenta='$cuenta' and id='$id'");
    $updsaldov=mysqli_query($con,"UPDATE historico SET saldo='$newsaldo' WHERE  cuenta='$cuenta' and id='$id'");
    header("location:../abonos/abono.php?cuenta='$cuenta'");
}
