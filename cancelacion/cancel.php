<?php 
 session_start();
 if(!$_SESSION['usuario']){
    header("location:../index.html");
 }else{
    require "../app/conection.php";
    $mot=isset($_POST['motivo'])?$_POST['motivo']:"";
    $id=isset($_POST['id'])?$_POST['id']:"";
    $cuenta=isset($_POST['cuent'])?$_POST['cuent']:"";
    $art=isset($_POST['art'])?$_POST['art']:"";
echo $mot;
    echo $id."-".$cuenta."-".$art;
if($id!="" and $cuenta!="" and $art!=""){
$busv=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'");
while($rowv=mysqli_fetch_array($busv)){
   $saldoh=$rowv['saldo'];
   $precioh=$rowv['precio'];
   $bush=mysqli_query($con,"SELECT * FROM venta WHERE  id='$id' and cuenta='$cuenta' and articulo='$art'");
while($rowh=mysqli_fetch_array($bush)){
   $saldov=$rowh['saldo'];
   $preciov=$rowh['precio'];
}
$newprecio=$precioh-$preciov;
$newsaldo=$saldoh-$saldov;
}
$cancel=mysqli_query($con,"INSERT INTO `cancelaciones`( `fecha`,`cuenta`, `articulo`, `motivo`) VALUES ('$today','$cuenta','$art','$mot')");
    $sqldl=mysqli_query($con,"UPDATE venta  SET saldo='0', nulo='cancelada' WHERE id='$id' and cuenta='$cuenta' and articulo='$art'");
    if($newsaldo>0){
      $sqlup=mysqli_query($con,"UPDATE historico SET saldo='$newsaldo',precio='$newprecio' WHERE cuenta='$cuenta' ");
    }else if($newsaldo<=0){
    $sqlup=mysqli_query($con,"UPDATE historico SET saldo='$newsaldo', precio='$newprecio',nulo='Cancelada' WHERE cuenta='$cuenta' ");}
    $sql=mysqli_query($con,"SELECT * FROM inventario  WHERE  product='$art'");
 mysqli_data_seek($sql,($numr=mysqli_num_rows($sql)-1));
 $row=mysqli_fetch_assoc($sql);
 $invqty=$row['qty'];
 $newQty=$invqty+1;
 echo "Paso de ".$invqty."-a-".$newQty;
    $sqladdinv=mysqli_query($con,"UPDATE inventario SET qty='$newQty' WHERE product='$art'");
   header("location:cancelacion.php");
}
 }?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cancelacion</title>
 </head>
 <body>
    <div><a href="cancelacion.php"><button>atras</button></a></div>
 </body>
 </html>
