<?php 
require "../app/conection.php";
$ids=isset($_GET['ids'])?$_GET['ids']:"";
$cuenta=isset($_GET['cuenta'])?$_GET['cuenta']:"";
$total=isset($_GET['total'])?$_GET['total']:"";
$enganche=isset($_GET['enganche'])?$_GET['enganche']:"";
$saldo=$total-$enganche;

if($ids==""){
    header("location:../principal.php");
}else{
    print ($cuenta.$total.$enganche.$saldo);
    $buscarOrgCuenta=mysqli_query($con,"SELECT * FROM historico WHERE id='$ids'");
    while($row=mysqli_fetch_array($buscarOrgCuenta)){
        $cuentaOrg=$row['cuenta'];
    }
    $idV=[];
    $buscarVenta=mysqli_query($con,"SELECT * FROM venta WHERE cuenta='$cuentaOrg' ");  
    $numero = mysqli_num_rows($buscarVenta);
    while($row=mysqli_fetch_array($buscarVenta)){
        $idV[] = $row['id'];   
    }
    $tvf=intval($total)/$numero;
    $evf=intval($enganche)/$numero;
    $svf=intval($saldo)/$numero;
    for ($i=0; $i < $numero; $i++) {
      $updateVenta=mysqli_query($con,"UPDATE venta SET cuenta='$cuenta', precio='$tvf', enganche='$evf', saldo='$svf' WHERE id='$idV[$i]' AND cuenta='$cuentaOrg' ");  
    }
    $updateHIstorico=mysqli_query($con,"UPDATE historico SET cuenta='$cuenta', precio='$total', enganche='$enganche', saldo='$saldo' WHERE id='$ids' AND cuenta='$cuentaOrg' ");
 
    header("location:../principal.php");
    

}