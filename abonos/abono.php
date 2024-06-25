<?php 
session_start();
require "../app/conection.php";
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$art=isset($_POST['art'])?$_POST['art']:"";
$cli=isset($_POST['client'])?$_POST['client']:"";
$abono=isset($_POST['abo'])?$_POST['abo']:"";
$resto=isset($_POST['rest'])?$_POST['rest']:"";
$recibo=isset($_POST['recibo'])?$_POST['recibo']:"";

date_default_timezone_set("America/Mexico_City");
$today=isset($_POST['today'])?$_POST['today']:"";
$today=date("d-m-Y",strtotime($today));
//echo $today;

if($cli!="" and $abono!="" and $resto!=""){
    $salnewtt=0;
   $sqy=mysqli_query($con,"UPDATE  historico SET saldo='$resto' WHERE cuenta='$cuenta' and cliente='$cli'");
    if($sqy){
        $sqy=mysqli_query($con,"INSERT INTO `abonos`( `cuenta`, `client`, `fechab`, `abono`, `NoRec`) VALUES ('$cuenta','$cli','$today','$abono','$recibo')");
    }
    
    
    $sqyventa=mysqli_query($con,"SELECT * FROM venta WHERE cuenta='$cuenta' and cliente='$cli' and saldo>0 ORDER BY saldo asc");
    $rowsnum=mysqli_num_rows($sqyventa);
    While($rowvv=mysqli_fetch_array($sqyventa)){
        
        $arti=$rowvv['articulo'];
        $saldonew=$rowvv['saldo'];
       // echo $saldonew."<br>";
       if($saldonew>=($abono/$rowsnum)){
        $salnewtt=$saldonew-($abono/$rowsnum);
        $updateventa=mysqli_query($con,"UPDATE venta SET saldo=$salnewtt WHERE articulo='$arti' and cuenta='$cuenta' and cliente='$cli'");
    }else if($saldonew<($abono/$rowsnum)){
        $abono=$abono-$saldonew;
        $salnewttl=0;
       // echo $abono."<br";
        $updateventa=mysqli_query($con,"UPDATE venta SET saldo=$salnewttl WHERE articulo='$arti' and cuenta='$cuenta' and cliente='$cli'");
        $rowsnum--;
       // echo "numOfRows Change = ".$rowsnum."<br>";
        
    }
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
img{
    width: 50px;
    height: 50px;
}
</style>
</head>
<body>
<div><small><a href="clientes.php"><button>Atras</button></a></small>
<button><a href="abonosCli.php?cuenta=<?php echo $cuenta?>"><img src="excel.jpg" alt="" id="excel_client"></a></button></div>
    <div align="center"><h1>Formato de abono</h1></div>
<table>
    <thead>
    <th>Cliente</th>
    <th>Cuenta</th>
    <th>Abono semanal</th>
    <th>Saldo anterio</th>
    <th>Abono</th>
    <th>Nuevo saldo</th>
     <th>No° de recibo</th>  
     <th>Fecha</th>
     <th>Abonoar</th>
    </thead>
    <tbody>
        <?php 
        if($cuenta!=""){
        $sqy=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'");}else{
            header("location:../principal.php");
        }while($row=mysqli_fetch_array($sqy)){
            $cli=$row['cliente'];
            $cuenta=$row['cuenta'];
            $art=$row['articulo'];
            $saldo=$row['saldo'];
            $semanal=$row['semanal'];
        }
        ?>
        <tr>
           
            <td><?php echo $cli;?></td>
            <td><?php echo $cuenta;?></td>
           <!-- <td><?php echo $art;?></td>-->
                <td><?php echo $semanal;?></td>
            <td><?php echo $saldo;?></td>
            <td><input type="number" name="abono" id="abono" value="0" min="0" required onchange="return abono()"></td>
            <td><input type="number" name="resto" id="resto" value="0" min="0" required></td>
            <form action="abono.php" method="POST">
             <td><input type="number" name="recibo" id="recibo" value="0" min="1" required></td>   
            <input type="hidden" name="rest" id="rest" >
            <input type="hidden" name="abo" id="abo" >
           
            <input type="hidden" name="art" id="art" value="<?php echo $art;?>">
            <input type="hidden" name="client" id="client" value="<?php echo $cli;?>">
            <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta;?>">    
            <input type="hidden" name="saldo" id="saldo" value="<?php echo $saldo;?>">
            <td><input type="date" name="today" id="today" required></td>
            <td><input type="submit" name="enviar" id="enviar" value="abonar"></td>
    </form>
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
                <th>Modificar</th>
            </thead>
            <tbody>
                <?php 
                $i=0;
                $fechas=[];
                $buscarFecha=mysqli_query($con,"SELECT fechab FROM abonos WHERE cuenta='$cuenta' and client='$cli' ");
                while($rowfecha=mysqli_fetch_array($buscarFecha)){
                    $fechas[$i]=strtotime($fechabonos=$rowfecha['fechab']);
                    $i++;

                }    
                sort($fechas);

                
                for($i=0;$i<count($fechas);$i++){
                    $datesab=date("d-m-Y",$fechas[$i]);
                $qry=mysqli_query($con,"SELECT * FROM abonos WHERE cuenta='$cuenta' and client='$cli' and fechab='$datesab' ");
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
                    <td><form action="modabono.php" method="POST"><input type="hidden" name="recibo" id="recibo" value="<?php echo $recibo;?>">
                    <input type="submit" name="enviar" id="enviar" value="Modificar"></form></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<script>
   
    function abono(){
   
        var saldo=document.getElementById("saldo").value;
        var abono=document.getElementById("abono").value;
        document.getElementById("abo").value=document.getElementById("abono").value;
        if(abono<=0){
            alert("El abono no puede ser menor o igual a 0 ");
            document.getElementById("abono").value=0;
        }
        if(abono>0){
        if( saldo-abono>=0){
            document.getElementById("resto").value=saldo-abono;
            document.getElementById("rest").value=document.getElementById("resto").value;
      
        }else{
            alert("El abono es mayor que el capital");
        } }else{ document.getElementById("resto").value=saldo;}
    }
</script>

<?php } ?>