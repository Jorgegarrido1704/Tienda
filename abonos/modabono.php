<?php 
session_start();
require "../app/conection.php";
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
    $modi=isset($_POST['recibo'])?$_POST['recibo']:"";
    $cu=isset($_POST['cuent'])?$_POST['cuent']:"";
   // echo $modi;
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$cli=isset($_POST['cliente'])?$_POST['cliente']:"";
$abono=isset($_POST['abono'])?$_POST['abono']:0;
$id_r=isset($_POST['id_r'])?$_POST['id_r']:"";
$id=isset($_POST['id'])?$_POST['id']:"";
$fecha=isset($_POST['fechab'])?$_POST['fechab']:"";
$saldo=0;
date_default_timezone_set("America/Mexico_City");
$today=date("d-m-Y");



if($id_r>0){
    echo"eliminar<br>";
    $buscarHistorial=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'  ");
    while($rowhis=mysqli_fetch_array($buscarHistorial)){
    $saldo=$rowhis['saldo'];} $saldo=(int)$saldo+$abono;
    $updateHistorial=mysqli_query($con,"UPDATE historico SET saldo=$saldo WHERE cuenta='$cuenta' ");
    $buscarticulo=mysqli_query($con,"SELECT * FROM venta WHERE cuenta='$cuenta'  ORDER BY saldo desc");
    $nr=mysqli_num_rows($buscarticulo);
    While($rowventas=mysqli_fetch_array($buscarticulo)){
        $id_venta=$rowventas['id'];
        $saldoart=$rowventas['saldo'];
        $precio=$rowventas['precio'];
        $enganche=$rowventas['enganche'];
        $salt=$precio-$enganche;
      
        if($salt>($saldoart+$abono)){
            $saldup=$saldoart+$abono;
       
            $updasaldo=mysqli_query($con,"UPDATE venta SET saldo=$saldup WHERE id='$id_venta' and cuenta='$cuenta'  ");
           $abono=0;
        }else if($salt<=($saldoart+$abono) and $abono>0){
            
            $updasaldo=mysqli_query($con,"UPDATE venta SET saldo=$salt WHERE id='$id_venta' and cuenta='$cuenta'  ");
            $abono=$abono-($salt-$saldoart);
        
        }
        if($buscarticulo){
            $deleteabono=mysqli_query($con,"DELETE FROM abonos WHERE id='$id_r'");
          header("location:clientes.php");
        }
    }

}
if($id>0){
  //  echo "modificar-id=".$id;
    $updatenota=mysqli_query($con,"UPDATE abonos SET  fechab='$fecha',NoRec='$modi' WHERE id='$id' ");
 header("location:clientes.php");
}
}
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
<div><small><a href="clientes.php"><button>Atras</button></a></small></div>
    <div align="center"><h1>Editar abono</h1></div>


    
    <div>
        <table>
            <thead>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Cuenta</th>
                <th>Abono</th> 
                <th>No° de recibo</th>  
                <th>Modificar</th>
                <th>Eliminar</th>
            </thead>
            <tbody>
                <?php 
                $qry=mysqli_query($con,"SELECT * FROM abonos WHERE NoRec='$modi' and cuenta='$cu' ");
                $rowab=mysqli_fetch_assoc($qry);
                    $id=$rowab['id'];
                    $cuenta=$rowab['cuenta'];
                    $client=$rowab['client'];
                    $fechaab=$rowab['fechab'];
                    $abonos=$rowab['abono'];
                    $recibo=$rowab['NoRec']
                ?>
                <tr><form action="modabono.php" method="POST">
                    <td><input type="text" name="fechab" id="fechab" value="<?php echo $fechaab;?>"></td>
                    <td><?php echo $client;?></td>
                    <td><?php echo $cuenta;?></td>
                    <td><?php echo $abonos;?></td>
                    <td><input type="number" name="recibo" id="recibo" min="0" required value="<?php echo $recibo;?>"></td>
                    <td><input type="hidden" name="id" id="id" value="<?php echo $id;?>"> 
                         <input type="submit" name="enviar" id="enviar" value="Modificar"></form></td>
                    <td><form action="modabono.php" method="POST"> 
                        <input type="hidden" name="id_r" id="id_r" value="<?php echo $id;?>"> 
                    <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta;?>">
                    <input type="hidden" name="recibo" id="recibo" value="<?php echo $recibo;?>">
                    <input type="hidden" name="abono" id="abono" value="<?php echo $abonos;?>">
                    
                    <input type="submit" name="enviar" id="enviar" value="Eliminar"></form></td>

                </tr>
                <?php  ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
   document.forms[0].onsubmit=function(){
   var clie= document.getElementById("cliente").value;
    var cuenta=document.getElementById("cuenta").value;
    var abono=document.getElementById("abono").value;
   var reci= document.getElementById("recibo").value;
    if(clie!="" && cuenta!="" && abono!="" && reci!=""){
        return true;
    }else{
        alert("Faltan campos por enviar");
        return false;
    }

   }
</script>

<?php  ?>