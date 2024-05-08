<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
require "app/conection.php";
$date=isset($_POST['date'])?$_POST['date']:"";
$date=date("d-m-Y",strtotime($date));
echo  "<br>".$date;
$formaDpago=isset($_POST['fo'])?$_POST['fo']:"";
$plazo=isset($_POST['plazo'])?$_POST['plazo']:"";
echo  "<br>".$plazo;
$ruta=isset($_POST['ruta'])?$_POST['ruta']:"";
echo  "<br>".$ruta;
$cuenta=isset($_POST['cuenta'])?$_POST['cuenta']:"";
echo  "<br>".$cuenta;
if($cuenta==0){
    $select=mysqli_query($con,"SELECT * FROM historico ORDER BY cuenta DESC LIMIT 1");
    $row=mysqli_fetch_assoc($select);
    $cuenta=$row['cuenta']+1;
}
$cliente=isset($_POST['cliente'])?$_POST['cliente']:"";
$client=strtoupper($cliente);
echo  "<br>".$cliente;
$aval=isset($_POST['aval'])?$_POST['aval']:"";
$aval=strtoupper($aval);
echo  "<br>".$aval;
$Dclient=isset($_POST['domcli'])?$_POST['domcli']:"";
$Dclient=strtoupper($Dclient);
$espo=isset($_POST['espo'])?$_POST['espo']:"";
echo  "<br>".$Dclient;
$Daval=isset($_POST['domav'])?$_POST['domav']:"";
$Daval=strtoupper($Daval);
echo  "<br>".$Daval;
$col=isset($_POST['col'])?$_POST['col']:"";
$col=strtoupper($col);
echo  "<br>".$col;
$ref2=isset($_POST['ref2'])?$_POST['ref2']:"";
$ref2=strtoupper($ref2);
echo  "<br>".$ref2;


$domref2=isset($_POST['domref'])?$_POST['domref']:"";
$domref2=strtoupper($domref2);
echo  "<br>".$domref2;
$promotor=isset($_POST['promotor'])?$_POST['promotor']:"";
echo  "<br>".$promotor;
$ref1=isset($_POST['ref1'])?$_POST['ref1']:"";
$ref1=strtoupper($ref1);
echo  "<br>".$ref1;
$vendedor=isset($_POST['vendedor'])?$_POST['vendedor']:"";
$vendedor=strtoupper($vendedor);
echo  "<br>".$vendedor;
$cobrador=isset($_POST['cobrador'])?$_POST['cobrador']:"";
$cobrador=strtoupper($cobrador);
echo  "<br>".$cobrador;
$domref1=isset($_POST['domref1'])?$_POST['domref1']:"";
$domref1=strtoupper($domref1);
echo  "<br>".$domref1;
$entreg=isset($_POST['entreg'])?$_POST['entreg']:"";
$entreg=strtoupper($entreg);
echo  "<br>".$entreg;
$art = isset($_POST['articulo']) ? $_POST['articulo'] : [];
$art = array_map('strtoupper', $art);

$numprod = isset($_POST['cantart']) ? (int)$_POST['cantart'] : 0;
echo "<br>" . $numprod;

$cantidad = isset($_POST['cantidpro']) ? $_POST['cantidpro'] : [];
$prec = isset($_POST['pre']) ? $_POST['pre'] : "";
$eng = isset($_POST['eng']) ? $_POST['eng'] : "";
$sald = isset($_POST['sa']) ? $_POST['sa'] : "";

echo $formaDpago . "-" . $prec . "-" . $eng . "-" . $sald;


for ($i = 0; $i < $numprod; $i++) {
    echo "<br>" . $cantidad[$i];
    echo "<br>" . $art[$i];
}


if($cliente!="" and $numprod>0){
    /*$busdup=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta' and art='$art'");
    $numrowdup=mysqli_num_rows($busdup);
    if($numrowdup>0){
        echo "<script>alert('venta ya capturada, revise la informacíon');</script>";
    }else{*/
        $duplicado=mysqli_query($con,"SELECT * FROM historico WHERE cuenta='$cuenta'");
$numrows=mysqli_num_rows($duplicado);
if($numrows>0){
    echo "Venta ya registrada";
    header("location:principal.php");
}else{       for($i=0;$i<$numprod;$i++){
            $qryartp=mysqli_query($con,"SELECT * FROM inventario WHERE product='$art[$i]'" );
            while($row=mysqli_fetch_array($qryartp)){     if($plazo==0){$pred=$row['CONTADO'];$semanal=0;}   else if($plazo>0){     $pred=$row['precio'.$plazo];$semanal=$row['semanal'.$plazo];}
                $engd=round($eng/$numprod);
                $saldd=$pred-$engd;}  
                if($plazo==0){    
     $qryventa=mysqli_query($con,"INSERT INTO `venta`( `fecha`, `semanal`, `meses`, `ruta`, `cuenta`, `cliente`, `aval`, `domcli`, `espo`, `domaval`, `col`, `ref2`, `domre2`, `promotor`, `ref1`, `vendedor`, `cobrador`, `domref1`, `entrego`, `cantArt`, `articulo`, `precio`, `enganche`, `saldo`) VALUES ('$date','$semanal','$plazo','$ruta','$cuenta','$cliente','$aval','$Dclient','$espo','$Daval','$col','$ref2','$domref2','$promotor','$ref1','$vendedor','$cobrador','$domref1','$entreg','$cantidad[$i]','$art[$i]','$pred','$engd','0')");
        $bc=mysqli_query($con,"SELECT product,qty FROM inventario WHERE product='$art[$i]'");
    while($rb=mysqli_fetch_array($bc)){
        $articulo=$rb['product'];
        $qt=$rb['qty'];}
        $newqty=$qt-(int)$cantidad[$i];
        $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$articulo',1,'Salida de producto - Venta')");
    $q=mysqli_query($con,"UPDATE inventario SET qty='$newqty' WHERE product='$articulo'");
     }else if($plazo>0){    
            $qryventa=mysqli_query($con,"INSERT INTO `venta`( `fecha`, `semanal`, `meses`, `ruta`, `cuenta`, `cliente`, `aval`, `domcli`, `espo`, `domaval`, `col`, `ref2`, `domre2`, `promotor`, `ref1`, `vendedor`, `cobrador`, `domref1`, `entrego`, `cantArt`, `articulo`, `precio`, `enganche`, `saldo`) VALUES ('$date','$semanal','$plazo','$ruta','$cuenta','$cliente','$aval','$Dclient','$espo','$Daval','$col','$ref2','$domref2','$promotor','$ref1','$vendedor','$cobrador','$domref1','$entreg','$cantidad[$i]','$art[$i]','$pred','$engd','$saldd')");
               $bc=mysqli_query($con,"SELECT product,qty FROM inventario WHERE product='$art[$i]'");
           while($rb=mysqli_fetch_array($bc)){
               $articulo=$rb['product'];
               $qt=$rb['qty'];}
               $newqty=$qt-(int)$cantidad[$i];
               $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$articulo',1,'Salida de producto - Venta')");
           $q=mysqli_query($con,"UPDATE inventario SET qty='$newqty' WHERE product='$articulo'");
       
       
     }
        }
        $qryhist=mysqli_query($con,"INSERT INTO `historico`( `fecha`, `semanal`, `meses`, `ruta`, `cuenta`, `cliente`, `aval`, `domcli`, `espo`, `domaval`, `col`, `ref2`, `domre2`, `promotor`, `ref1`, `vendedor`, `cobrador`, `domref1`, `entrego`, `cantArt`, `articulo`, `precio`, `enganche`, `saldo`) VALUES ('$date','$formaDpago','$plazo','$ruta','$cuenta','$cliente','$aval','$Dclient','$espo','$Daval','$col','$ref2','$domref2','$promotor','$ref1','$vendedor','$cobrador','$domref1','$entreg','','','$prec','$eng','$sald')");
          
if($qryhist){
   header("location:impresion.php");
}
}}}

