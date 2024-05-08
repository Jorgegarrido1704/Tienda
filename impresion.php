<?php 
session_start();
require "app/conection.php";
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
if($cuenta!=""){$buscar = "SELECT * FROM historico WHERE cuenta='$cuenta'";}else{
$buscar = "SELECT * FROM historico ORDER BY id DESC LIMIT 1";}
$qry = mysqli_query($con, $buscar);

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
$cobrador=$row['cobrador'];
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
 <meta http-equiv="REFRESH" content="3;url=principal.php">
 
 <style>
   

    body {
        margin: 0.5in; /* Ajusta el espacio alrededor del contenido */
    }

    .head, .datos  {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 10px; /* Ajusta el espacio entre bloques */
        font-size: x-large;
    }
   
    .head h1, .datos h1, .datos-linea h1 {
        margin-right: 20px; /* Ajusta el margen entre los elementos */
    }
   
  
    .datos div {
        width: 48%; /* Ancho del 48% para que haya dos divs en una fila */
        box-sizing: border-box; /* Incluye el relleno y el borde en el ancho total */
        margin-bottom: 10px; /* Ajusta el espacio entre divs */
        font-size: x-large;
    }  
    .datos-linea {
        display: flex;
        flex-direction: row; /* Alinea los elementos en una fila */
        align-items: center; /* Alinea los elementos verticalmente al centro */
        margin-bottom: 10px; /* Ajusta el espacio entre elementos */
        font-size: x-large;
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
        height: 70px;
    }


     
 </style>
    <title></title>
</head>
<body>
    
<div class="head">
    <h1>Fecha: <?php echo date("d-m-y", strtotime($fecha)); ?></h1>
    <h1>FORMA DE PAGO: $ <?php echo $forma; ?></h1>
    <h1>Plazo: <?php echo $plazo; ?> Meses</h1>
    <h1>Ruta: <?php echo $ruta; ?></h1>
    <h1>Cuenta: <?php echo $cuenta; ?></h1>
</div>

<div class="datos">
    <div>
        <h1>Cliente: <?php echo $client; ?></h1>
                <h1>Domicilio: <?php echo $dom; ?></h1>
    </div>

    <div>
       <h1>Aval: <?php echo $aval; ?></h1>
        <h1>Domicilio Aval: <?php echo $domav; ?></h1>
    </div>
    
    <div>
        <h1>Colonia: <?php echo $col; ?></h1>
       <h1>Ref 1: <?php echo $ref1; ?></h1>
          </div>
    <div>
       <h1>Esposo(a): <?php echo $espo; ?></h1>
        <h1>Domicilio Ref 1: <?php echo $domref1; ?></h1>
    </div>
    <div>
        <h1>Ref 2: <?php echo $ref2; ?></h1></div><div>
       <h1>Domicilio Ref 2: <?php echo $domref2; ?></h1>
    </div></div>
    <div class="datos-linea">
            <div><h1>Promotor: <?php echo $promo; ?></h1></div>
            <div><h1>Vendedor: <?php echo $vend; ?></h1></div>
            <div><h1>Cobrador: <?php echo $cobrador; ?></h1></div>
    </div>
    <div>
    
            <table class="art">
                <thead>
                    <th class="art"><h1>Cantidad</h1></th>
                    <th class="art"><h1>Articulo</h1></th>
                    <th class="art"><h1>Precio</h1></th>
                </thead>
<?php $sqy=mysqli_query($con,"SELECT * FROM venta WHERE cliente='$client' and cuenta='$cuenta'");
    while($rowv=mysqli_fetch_array($sqy)){
        $cantart=$rowv['cantArt'];
        $articulo=$rowv['articulo'];
        $precioart=$rowv['precio'];
        ?>
        <tbody>
            <tr class="art">
            <td class="art"><h1><?php echo $cantart; ?></h1></td>
            <td class="art"><h1><?php echo $articulo; ?></h1></td>
            <td class="art"><h1><?php echo $precioart; ?></h1></td>
            </tr>
 <?php   }?>
            </tbody>
            </table>
        

    </div>
    <div class="datos">
    <h1>Total:$ <?php echo $precio; ?></h1>
    <h1>Enganceh:$ <?php echo $enganche; ?></h1>
    <h1>Saldo:$ <?php echo $saldo; ?></h1>
    <h1>Fecha de vencimiento: <?php echo $vencimiento; ?></h1>
    <table>
        <thead>
        <th class="cob"><h2>Fecha</h2></th>
        <th class="cob"><h2>Abono</h2></th>
        <th class="cob"><h2>Saldo</h2></th>
        <th class="cob"><h2>REC. NO.</h2></th>
        <th class="cob"><h2>Fecha</h2></th>
        <th class="cob"><h2>Abono</h2></th>
        <th class="cob"><h2>Saldo</h2></th>
        <th class="cob"><h2>REC. NO.</h2></th>
        </thead>
        <tbody>
            
            <?php
            $times=$plazo*2;
            for($i=0;$i<3;$i++){?>
            <tr class="cob"><td class="cob"></td> <td class="cob"></td> <td class="cob"></td> 
            <td class="cob"></td> <td class="cob"></td><td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> </tr>
            <?php }?>
        </tbody>
    </table>
</div>

    <table>
        <thead>
        <th class="cob"><h1>Fecha</h1></th>
        <th class="cob"><h1>Abono</h1></th>
        <th class="cob"><h1>Saldo</h1></th>
        <th class="cob"><h1>REC. NO.</h1></th>
        <th class="cob"><h1>Fecha</h1></th>
        <th class="cob"><h1>Abono</h1></th>
        <th class="cob"><h1>Saldo</h1></th>
        <th class="cob"><h1>REC. NO.</h1></th>
        </thead>
        <tbody>
            
            <?php
            
            for($i=0;$i<21;$i++){?>
            <tr class="cob"><td class="cob"></td> <td class="cob"></td> <td class="cob"></td> 
            <td class="cob"></td> <td class="cob"></td><td class="cob"></td> <td class="cob"></td>
            <td class="cob"></td> </tr>
            <?php }?>
        </tbody>
    </table>
    </body>
</html>

<script>
        // JavaScript function to handle printing when the page loads
        window.onload = function() {
            window.print(); // This opens the print dialog when the page loads
        };
    </script>

    <?php 
    }
  ?>