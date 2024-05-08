<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else {
    require "../app/conection.php";
    $id=isset($_POST['id'])?$_POST['id']:"";

    $pro=isset($_POST['prodh'])?$_POST['prodh']:"";
    $pro=strtoupper($pro);
    $cat=isset($_POST['cath'])?$_POST['cath']:"";
    $cat=strtoupper($cat);
$descp=isset($_POST['desch'])?$_POST['desch']:"";
$descp=strtoupper($descp);
$cantidad=isset($_POST['qty'])?$_POST['qty']:"";
$precio=isset($_POST['price'])?$_POST['price']:"";
date_default_timezone_set("America/Mexico_City");
$date=date("d-m-Y H:i");
  //  echo $id.$pro.$cat.$descp.$cantidad.$precio;
    if($pro!="" and $cat!="" and $cantidad!="" and $precio!=""){
        $p1=($precio*1.05);$p2=(($p1*1.05));$p3=(($p2*1.05));$p4=(($p3*1.05));$p5=(($p4*1.05));$p6=(($p5*1.05));$p7=(($p6*1.05));$p8=(($p7*1.05));$p9=(($p8*1.05));$p10=(($p9*1.05));$p11=(($p10*1.05));$p12=(($p11*1.05));
        $s1=($p1/(1*4));$s2=($p2/(2*4));$s3=($p3/(3*4));$s4=($p4/(4*4));$s5=($p5/(5*4));$s6=($p6/(6*4));$s7=($p7/(7*4));$s8=($p8/(8*4));$s9=($p9/(9*4));$s10=($p10/(10*4));$s11=($p11/(11*4));$s12=($p12/(12*4));
      //   $qry=mysqli_query($con,"INSERT INTO `inventario`( `category`, `product`, `qty`, `CONTADO`, `precio1`, `precio2`, `precio3`, `precio4`, `precio5`, `precio6`, `precio7`, `precio8`, `precio9`, `precio10`, `precio11`, `precio12`, `semanal1`, `semanal2`, `semanal3`, `semanal4`, `semanal5`, `semanal6`, `semanal7`, `semanal8`, `semanal9`, `semanal10`, `semanal11`, `semanal12`) VALUES  ('$cat','$prod','$qty','$precio','$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9','$p10','$p11','$p12','$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8','$s9','$s10','$s11','$s12')");
      $buscarprod=mysqli_query($con,"SELECT qty FROM inventario WHERE product='$pro'");
      while($row=mysqli_fetch_array($buscarprod)){
          $proqt=$row['qty'];
          if($proqt>$cantidad){
              $tprod=$proqt-$cantidad;
              $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$pro','$tprod','Salida de producto - inventario')");
          }else  if($proqt<$cantidad){
              $tprod=$cantidad-$proqt;
              $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$pro','$tprod','Entrada de producto - inventario')");
          }
      }
        $qry=mysqli_query($con,"UPDATE inventario SET category='$cat', product='$pro',qty='$cantidad',CONTADO='$precio',precio1='$p1',precio2='$p2',precio3='$p3',precio4='$p4',precio5='$p5',precio6='$p6',precio7='$p7',precio8='$p8',precio9='$p9',precio10='$p10',precio11='$p11',precio12='$p12',semanal1='$s1',semanal2='$s2',semanal3='$s3',semanal4='$s4',semanal5='$s5',semanal6='$s6',semanal7='$s7',semanal8='$s8',semanal9='$s9',semanal10='$s10',semanal11='$s11',semanal12='$s12' WHERE id='$id' ");
        if ($qry){
            header("location:listaInv.php");
        }
    }
   if($id!="" ){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
</head>
<body>
<style>   body{
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
input[type="text"]{
    width: 400px;
}
input[type="number"]{
    width: 100px;
}
</style>
<div><small><a href="listaInv.php"><button>Atras</button></a></small></div>
<div align="center"> 
    <h1>Modicacion de inforamcion</h1>
    <table>
        <Thead>
            <th><h2>Categoria</h2></th>
            <th><h2>Producto</h2></th>
            <th><h2>Cantidad en inventario</h2></th>
            <th><h2>Precio Unitario</h2></th>
            <th><h2>Modificar</h2></th>
        </Thead>
        <tbody>
            <?php 
             $qry=mysqli_query($con,"SELECT * FROM inventario WHERE id LIKE '$id'");
            while($row=mysqli_fetch_array($qry)){
                $id=$row['id'];
                $cat=$row['category'];
                $prod=$row['product'];
                
                $qty=$row['qty'];
                $price=$row['CONTADO'];
                ?>
                <tr>
                    <td><h2><input type="text" name="cat" id="cat" value="<?php echo $cat; ?>"></h2></td>
                    <td><h2><input type="text" name="prod" id="prod" value="<?php echo $prod; ?>"></h2></td>
                    
                    <td><form action="modificar.php" method="POST"><h2><input type="number" name="qty" id="qty" value="<?php echo $qty; ?>" min="0" required></h2></td>
                    <!--<form action="listaInv.php" method="POST"  id="cantpro">
                        <input type="hidden" name="prod" id="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="ncan" id="ncan">
                        <input type="submit" name="cambio" id="cambio" value="Modificar"></form>
                    <td><h2><?php echo $price; ?></h2><form action="listaInv.php" method="POST"  id="precios">
                        <input type="hidden" name="prod" id="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="pre" id="pre">
                        <input type="submit" name="cambio" id="cambio" value="Modificar"></form></td>-->
                        <td><h2><input type="number" name="price" id="price" value="<?php echo $price;?>" min="0" required></h2></td>
                        <td>

                          <h2>  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="cath" id="cath" >
                          <input type="hidden" name="prodh" id="prodh" >
                          <input type="hidden" name="desch" id="desch" >
                          <input type="hidden" name="qtyh" id="qtyh ">
                          <input type="hidden" name="priceh" id="priceh" >
                            <input type="submit" name="enviar" id="enviar" value="Modificar"></h2>
                        </form></td>
                </tr>
                <?php } }else{
    header("location:listaInv.php");}?>
        </tbody>
    </table>

</div>
</body>
</html>
<script>
        document.forms[0].onsubmit= function () {
            document.getElementById('cath').value=document.getElementById('cat').value;
            document.getElementById('prodh').value=document.getElementById('prod').value;
            
            document.getElementById('qtyh').value=document.getElementById('qty').value;
            document.getElementById('priceh').value=document.getElementById('price').value;
            
        }
</script>
<?php 
} ?>