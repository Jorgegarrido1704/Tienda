<?php

session_start();
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
    require "../app/conection.php";
    $qry="";
$cuenta=isset($_POST['buscu'])?$_POST['buscu']:"";
$client=isset($_POST['buscl'])?$_POST['buscl']:"";
if($cuenta!="" and $client!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cliente Like '%%$client%%' AND cuenta  LIKE '%%$cuenta%%'");}
else if($cuenta!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cuenta  LIKE '%%$cuenta%%'");}
else if($client!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cliente Like '%%$client%%' ");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelaciones</title>
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
input[type="text"]{width: 200px;  max-width: 400px;}
input[type="number"]{ width: 70px;}
</style>
<script>
          function promptForCancel() {
    var promptText = prompt("Motivo de cancelacion: ");
    if (promptText === null || promptText === "") {
        return false; // Cancelled or empty input, block form submission
    } else {
        document.getElementById('motivo').value = promptText;
        return true; // Allow form submission
    }
}
        </script>
</head>
<body>
    <div><small><a href="../principal.php"><button>Atras</button></a></small></div>
    <div align="center">
        <h1>Cancelaciones</h1>
    <form action="cancelacion.php" method="POST"><label for="buscu">Buscar cuenta</label><input type="text" name="buscu" id="buscu" placeholder="001210">
    <label for="buscl">Buscar cliente</label><input type="text" name="buscl" id="buscl" placeholder="Juan Perez Garcia">
    <input type="submit" name="enviar" id="enviar" value="Buscar">
</form>
</div>
<div>
    <?php 
    if($qry!=""){ ?>
        <table>
            <thead>
                <th><h1>Cuenta</h1></th>
                <th><h1>Cliente</h1></th>
                <th><h1>Articulo</h1></th>
                <th><h1>precio</h1></th>
                <th><h1>saldo</h1></th>
                <th><h1>Cancelar</h1></th>
            </thead>
            <tbody>
            <?php 
            while($row=mysqli_fetch_array($qry)){
                $id=$row['id'];
                $client=$row['cliente'];
                $cuenta=$row['cuenta'];
                $art=$row['articulo'];
                $precio=$row['precio'];
                $saldo=$row['saldo'];
            if($saldo>0){
            ?>
            <tr>
            <td><?php echo $cuenta; ?></td>
                <td><?php echo $client; ?></td>
                <td><?php echo $art; ?></td>
                <td>$<?php echo $precio; ?></td>
                <td>$<?php echo $saldo; ?></td>
                <td><form action="cancel.php" method="POST"  onsubmit="return promptForCancel();">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="cuent" id="cuent" value="<?php echo $cuenta; ?>">
                    <input type="hidden" name="art" id="art" value="<?php echo $art; ?>">
                    <input type="hidden" name="motivo" id="motivo">
                    <input type="submit" name="enviar" id="enviar" value="Cancelar">
                </form></td>
            </tr>
            <?php }} ?>
            </tbody>
        </table>
        <?php  ?>
        <br>
        <div align='center'><h1>Canceladas</h1></div>
        <br>
        <table>
            <thead>
                <th><h1>Cuenta</h1></th>
                <th><h1>Cliente</h1></th>
                <th><h1>Articulo</h1></th>
                <th><h1>precio</h1></th>
               
                <th><h1>Cancelar</h1></th>
            </thead>
            <tbody>
            <?php 
        if($cuenta!="" and $client!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cliente Like '%%$client%%' AND cuenta  LIKE '%%$cuenta%%'");}
        else if($cuenta!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cuenta  LIKE '%%$cuenta%%'");}
        else if($client!=""){$qry=mysqli_query($con,"SELECT * FROM venta WHERE cliente Like '%%$client%%' ");}
        while($row=mysqli_fetch_array($qry)){
            $id=$row['id'];
            $client=$row['cliente'];
            $cuenta=$row['cuenta'];
            $art=$row['articulo'];
            $precio=$row['precio'];
            $saldo=$row['saldo'];

            $cancel=mysqli_query($con,"SELECT * FROM cancelaciones WHERE cuenta='$cuenta'");
            while($rowc=mysqli_fetch_array($cancel)){
            $mot=$rowc['motivo'];}
            if($saldo<=0){
        ?>
           
            <tr>
            <td><?php echo $cuenta; ?></td>
                <td><?php echo $client; ?></td>
                
                <td><?php echo $art; ?></td>
                <td><?php echo "$".$precio; ?></td>
                <td><?php echo $mot; ?></td>
              
            </tr>
            <?php }}?>
            </tbody>
        </table>

    <?php  }   ?>
</div>
</body>
</html>


<?php 
}
?>