<?php 
session_start();
require "../app/conection.php";
date_default_timezone_set("America/Mexico_City");
$empl=isset($_POST['vendedor'])?$_POST['vendedor']:"";
$fechaa=isset($_POST['fechaa'])?$_POST['fechaa']:"";
$fechade=isset($_POST['fechade'])?$_POST['fechade']:"";
if ($fechade != "" && $fechaa != "") {
    //echo "De: " . $fechade . " a " . $fechaa;
    
    //$fechade = strtotime(date("d-m-Y", strtotime($fechade)));
    //$fechaa = strtotime(date("d-m-Y", strtotime($fechaa)));
    
   // echo "<br>" . date("d-m-Y", $fechade) . "<br>" . date("d-m-Y", $fechaa) . "<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desglose de ventas</title>
</head>
<style>
  
        
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
}label{
    font: bold;
}
table{
    border: 2px lightslategray solid;
  
}
th{
    border: 1px lightblue solid;
}
td{
    align-items: center;
    text-align: center;
    border-bottom: 1px lightblue solid;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    background-color: blanchedalmond;
}

div .nota,table {
    width: 700px;
    height: 600px;
    border-radius: 5px;
    border: 1px solid #000; /* Fix the border declaration */
    background-color: lightgray;
    
}


</style>
<body>
    
    <div class="body">
        <div class="nota">
        <div><small><a href="comiciones.php"><button>Atras</button></a></small></div>
<table>
    <thead>
        <th>Nombre</th>
        <th>Fecha de venta</th>
        <th>Articulo</th>
        <th>Monto de venta</th>
        <th>comiciones</th>
    </thead>
    <tbody>
        <?php 
          $qryempleado=mysqli_query($con,"SELECT * FROM personal WHERE nombre='$empl'");
          while($row=mysqli_fetch_array($qryempleado)){
         $puesto=$row['puesto'];
          }
            $ventatt=0;
             $comit=0;
             $comis=0;
             $cuenta=0;
             $total=0;
           
             $qryvent = mysqli_query($con, "SELECT * FROM venta WHERE (vendedor='$empl' or promotor='$empl') ");   
             while($vv=mysqli_fetch_array($qryvent)){
                $fecha=$vv['fecha'];
                $date=strtotime($fecha);
                if($date >= $fechade && $date <= $fechaa){
                 $ventas=$vv['precio'];
                 $art=$vv['articulo'];
                 $cantArt=$vv['cantArt'];
                 $cuenta=$vv['cuenta'];
                 $ventatt=$ventatt+$ventas;
                 $qrycomi=mysqli_query($con,"SELECT * FROM inventario WHERE product='$art'");
                 While($comi=mysqli_fetch_array($qrycomi)){
                     $precont=$comi['CONTADO'];
                     if($puesto=="VENDEDOR"){
                     $comis=(int)($cantArt*($precont*0.08));
                 }else if($puesto=="PROMOTOR"){
                    $comis=(int)($cantArt*(($precont-($precont*0.08))*0.06));
                    $precont=round($precont*0.92);
                 }     }

                 $total=$total+$comis;
              ?>
            <tr>
                <td><?php echo $empl; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo $art; ?></td>
                <td><?php echo $precont; ?></td>
                <td><?php echo $comis; ?></td>
            </tr>
   <?php }  }  ?>
   <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo $total; ?></td>
            </tr>
    </tbody>
</table>

        </div>
    </div>
</body>
</html>