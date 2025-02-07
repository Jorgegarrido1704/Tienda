<?php 

require "../app/conection.php";

 $cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
 $interes=isset($_POST['interes'])?$_POST['interes']:"";
 $fecha=date("d-m-Y H:i");

mysqli_query($con,"INSERT INTO `interes`( `cuenta`, `interes`, `fecha`) VALUES ('$cuenta','$interes','$fecha')");
$datos=mysqli_query($con,"SELECT * FROM `historico` WHERE `cuenta` = '$cuenta'");
while($row=mysqli_fetch_array($datos)){
    $saldo=$row['saldo'];
}
$sal=$saldo+$interes;

mysqli_query($con,"UPDATE `historico` SET `saldo` = '$sal' WHERE `cuenta` = '$cuenta'");
$datosv=mysqli_query($con,"SELECT * FROM `venta` WHERE `cuenta` = '$cuenta'");
$num=mysqli_num_rows($datosv);
$intdiv=round($interes/$num);
while($rowv=mysqli_fetch_array($datosv)){
    $saldos=$rowv['saldo'];
    $saln=$saldos+$intdiv;
mysqli_query($con,"UPDATE `venta` SET `saldo` = '$saln' WHERE `cuenta` = '$cuenta' ");
}
header("location:../principal.php");
?>