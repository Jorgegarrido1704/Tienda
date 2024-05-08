<?php 
session_start();
require "../app/conection.php";
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
if($cuenta!=""){$buscar = "SELECT * FROM historico WHERE cuenta='$cuenta'";}else{
header("location:clientes.php");}
$qry = mysqli_query($con, $buscar);
$ruta=isset($_POST['ruta'])?$_POST['ruta']:"";
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
$cliente=isset($_POST['clie'])?$_POST['clie']:"";$client=strtoupper($cliente);
$aval=isset($_POST['aval'])?$_POST['aval']:"";$aval=strtoupper($aval);
$Dclient=isset($_POST['domcli'])?$_POST['domcli']:"";$Dclient=strtoupper($Dclient);
$espo=isset($_POST['espo'])?$_POST['espo']:"";
$Daval=isset($_POST['domaval'])?$_POST['domaval']:"";$Daval=strtoupper($Daval);
$col=isset($_POST['col'])?$_POST['col']:"";$col=strtoupper($col);
$ref2=isset($_POST['ref2'])?$_POST['ref2']:"";$ref2=strtoupper($ref2);
$domref2=isset($_POST['domref2'])?$_POST['domref2']:"";$domref2=strtoupper($domref2);
$promotor=isset($_POST['promotor'])?$_POST['promotor']:""; $promotor=strtoupper($promotor);
$ref1=isset($_POST['ref1'])?$_POST['ref1']:"";$ref1=strtoupper($ref1);
$vendedor=isset($_POST['vendedor'])?$_POST['vendedor']:"";$vendedor=strtoupper($vendedor);
$cobrador=isset($_POST['cobrador'])?$_POST['cobrador']:"";$cobrador=strtoupper($cobrador);
$domref1=isset($_POST['domref1'])?$_POST['domref1']:"";$domref1=strtoupper($domref1);
$fechanew=isset($_POST['fechanew'])?$_POST['fechanew']:"";
if($ruta!="" AND $cliente!=""){
$update=mysqli_query($con,"UPDATE venta SET fecha='$fechanew',ruta='$ruta', cliente='$cliente', aval='$aval', domcli='$Dclient', espo='$espo',domaval='$Daval',col='$col',ref2='$ref2',domre2='$domref2',promotor='$promotor',ref1='$ref1',vendedor='$vendedor',cobrador='$cobrador',domref1='$domref1' WHERE cuenta='$cuenta'");
$updateh=mysqli_query($con,"UPDATE historico SET fecha='$fechanew',ruta='$ruta', cliente='$cliente', aval='$aval', domcli='$Dclient', espo='$espo',domaval='$Daval',col='$col',ref2='$ref2',domre2='$domref2',promotor='$promotor',ref1='$ref1',vendedor='$vendedor',cobrador='$cobrador',domref1='$domref1' WHERE cuenta='$cuenta'");
if($update){
    header("location:clientes.php");
echo "update SUCCESSFULLY";
}
}


 while($row=mysqli_fetch_array($qry)){
$client=$row['cliente'];
    $dom=$row['domcli'];
$col=$row['col'];
$fecha=$row['fecha'];
$forma=$row['semanal'];
$plazo=$row['meses'];
$ruta=$row['ruta'];
$espo=$row['espo'];
$cuenta=$row['cuenta'];
$promo=$row['promotor'];
$ref1=$row['ref1'];
$domref1=$row['domref1'];
//$art=$row['artoculo'];
$aval=$row['aval'];
$domav=$row['domaval'];
//$cant=$row['cantArt'];
$ref2=$row['ref2'];
$domref2=$row['domre2'];
$vend=$row['vendedor'];
$cobra=$row['cobrador'];
$entrego=$row['entrego'];
$precio=$row['precio'];
$enganche=$row['enganche'];
$saldo=$row['saldo'];
$fechas = strtotime($fecha); 


$vencimientoTimestamp = strtotime("+$plazo months", $fechas);

$vencimiento = date("d-m-y", $vencimientoTimestamp);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
 
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

#btn{
    
    padding-right: 20px;
}
label{
    font: bold;
}


    .head, .datos  {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 10px; /* Ajusta el espacio entre bloques */
        font-size: x-large;
    }
   
    .head h3, .datos h3, .datos-linea h3 {
        margin-right: 20px; /* Ajusta el margen entre los elementos */
    }
   
  
    .datos div {
        width: 48%; /* Ancho del 48% para que haya dos divs en una fila */
        box-sizing: border-box; /* Incluye el relleno y el borde en el ancho total */
        margin-bottom: 10px; /* Ajusta el espacio entre divs */
    
        
    }  
    .datos-linea {
        display: flex;
        flex-direction: row; /* Alinea los elementos en una fila */
        align-items: center; /* Alinea los elementos verticalmente al centro */
        margin-bottom: 10px; /* Ajusta el espacio entre elementos */
      
    }
    table {
        width: 100%;
        background-color: lightyellow;
        border: solid 1px #000;
        page-break-inside: avoid; /* Evitar saltos de página dentro de la tabla */
    }

    th .art, tr .art, td .art {
        text-align: center;
        border: 1px solid #000;
        height: 30px;
    }
    th .cob, tr .cob, td .cob {
        text-align: center;
        border: 1px solid #000;
        height: 60px;
    }


     
 </style>
    <title></title>
</head>
<body>
<form action="editclient.php" method="POST">
<div class="head">
    <h3>Fecha: <input type="text" name="fechanew" id="fechanew" value="<?php echo $fecha; ?>"require autofocus></h3>
    <h3>FORMA DE PAGO: $ <?php echo $forma; ?></h3>
    <h3>Plazo: <?php echo $plazo; ?> Meses</h3>
    <h3>Ruta: <input type="number" name="ruta" id="ruta" value="<?php echo $ruta; ?>"></h3>
    <h3>Cuenta: <input type="hidden" name="cuenta" id="cuenta" value="<?php echo $cuenta; ?>"><?php echo $cuenta; ?></h3>
</div>

<div class="datos">
    <div>
        <h3>Cliente: <input type="text" name="clie" id="clie" value="<?php echo $client; ?>"></h3>
        <h3>Aval: <input type="text" name="aval" id="aval" value="<?php echo $aval; ?>"></h3>
    </div>

    <div>
        <h3>Domicilio: <input type="text" name="domcli" id="domcli" value="<?php echo $dom; ?>"></h3>
        <h3>Domicilio Aval:<input type="text" name="domaval" id="domaval" value=" <?php echo $domav; ?>"></h3>
    </div>
    
    <div>
        <h3>Colonia: <input type="text" name="col" id="col" value="<?php echo $col; ?>"></h3>
        <h3>Esposo(a): <input type="text" name="espo" id="espo" value=" <?php echo $espo; ?>"></h3>
    </div>
    <div>
        <h3>Ref1:<input type="text" name="ref1" id="ref1" value=" <?php echo $ref1; ?>"></h3>
        <h3>Domicilio Ref1: <input type="text" name="domref1" id="domref1" value="<?php echo $domref1; ?>"></h3>
    </div>
    <div>
        <h3>Ref2: <input type="text" name="ref2" id="ref2" value="<?php echo $ref2; ?>"></h3></div><div>
        <h3>Domicilio Ref2: <input type="text" name="domref2" id="domref2" value="<?php echo $domref2; ?>"></h3>
    </div></div>
    <div class="datos-linea">
            <div><h3>      <label for="promotor" id="trab">PROMOTOR</label><select name="promotor" id="promotor" >
        <option value="<?php echo $promo; ?>"><?php echo $promo; ?></option>
        <?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='PROMOTOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
    </select></h3></div>
            <div><h3><label for="vendedor" id="vend">Vendedor</label><select type="text" name="vendedor" id="vendedor">
<option value="<?php echo $vend; ?>" select><?php echo $vend; ?></option>
<?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='VENDEDOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
</select></h3></div>
            <div><h3> <label for="cobrador" id="sep">Cobrador</label><select type="text" name="cobrador" id="cobrador">
        <option value="<?php echo $cobra; ?>" select><?php echo $cobra; ?></option>
        <?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='COBRADOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
        </select></h3></div>
    </div>
    <div>
    
            <table class="art">
                <thead>
                    <th class="art"><h3>Cantidad</h3></th>
                    <th class="art"><h3>Articulo</h3></th>
                    <th class="art"><h3>Precio</h3></th>
                </thead>
<?php $sqy=mysqli_query($con,"SELECT * FROM venta WHERE cliente='$client' and cuenta='$cuenta'");
    while($rowv=mysqli_fetch_array($sqy)){
        $cantart=$rowv['cantArt'];
        $articulo=$rowv['articulo'];
        $precioart=$rowv['precio'];
        ?>
        <tbody>
            <tr class="art">
            <td class="art"><h3><?php echo $cantart; ?></h3></td>
            <td class="art"><h3><?php echo $articulo; ?></h3></td>
            <td class="art"><h3><?php echo $precioart; ?></h3></td>
            </tr>
 <?php   }?>
            </tbody>
            </table>
        

    </div>
    <div class="datos">
<?php $sqy=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'");
    while($rowvs=mysqli_fetch_array($sqy)){
      	$enganches=$rowvs['enganche'];
        $precios=$rowvs['precio'];
	$resto=$precios-$enganches;}
        ?>
    <h3>Total:$ <?php echo $precios; ?></h3>
    <h3>Enganceh:$ <?php echo $enganches; ?></h3>
    <h3>Saldo:$ <?php echo $resto; ?></h3>
    <h3>Fecha de vencimiento: <?php echo $vencimiento; ?></h3>

</div>
<div align="center">

<input type="submit" name="enviar" id="enviar" value= "Guardar">
</form></div>
   
    </body>
</html>

<script>
    document.forms['form'].onsubmit = function () {
   
    
    var client = document.getElementById("cliente").value;
    var dom = document.getElementById("domcli").value;
    var cuenta = document.getElementById("cuenta").value;
  
    var ruta = document.getElementById("ruta").value;
    var vendedor = document.getElementById("vendedor").value;
    var promotor = document.getElementById("promotor").value;
    var cobrador = document.getElementById("cobrador").value;
 
   
    var esp = document.getElementById("espo").value;

    if (
       
        client !== "" && dom !== "" && cuenta !== "" &&
          ruta !== "" &&
        vendedor !== "" && promotor !== "" && cobrador !== "" 
        
    ) {
        return true;
    } else {
        alert("Faltan datos por ingresar o algunos datos son inválidos.");
        return false;
    }
    return false; // Added this line to prevent the form from submitting if validation fails
};
    </script>

    <?php 
    }
  ?>