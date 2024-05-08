<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
require "../app/conection.php";
$cat=isset($_POST['categ'])?$_POST['categ']:"";
$cat=strtoupper($cat);
$prod=isset($_POST['pro'])?$_POST['pro']:"";
$prod=strtoupper($prod);
date_default_timezone_set("America/Mexico_City");
$date=date("d-m-Y H:i");
$qty=isset($_POST['qty'])?$_POST['qty']:"";
$precio=isset($_POST['prec'])?$_POST['prec']:"";
if ($cat!=""){

    $dqry=mysqli_query($con,"SELECT category,product FROM inventario WHERE category='$cat' and product='$prod'");
    $numrow=mysqli_num_rows($dqry);
    if($numrow>0){
        echo "<script>alert('Producto ya registrado')</script>";
     //   header("location:refresh=5;listaInv.php");
    }else{
        $p1=($precio*1.05);$p2=(($p1*1.05));$p3=(($p2*1.05));$p4=(($p3*1.05));$p5=(($p4*1.05));$p6=(($p5*1.05));$p7=(($p6*1.05));$p8=(($p7*1.05));$p9=(($p8*1.05));$p10=(($p9*1.05));$p11=(($p10*1.05));$p12=(($p11*1.05));
        $s1=($p1/(1*4));$s2=($p2/(2*4));$s3=($p3/(3*4));$s4=($p4/(4*4));$s5=($p5/(5*4));$s6=($p6/(6*4));$s7=($p7/(7*4));$s8=($p8/(8*4));$s9=($p9/(9*4));$s10=($p10/(10*4));$s11=($p11/(11*4));$s12=($p12/(12*4));
    $qry=mysqli_query($con,"INSERT INTO `inventario`( `category`, `product`, `qty`, `CONTADO`, `precio1`, `precio2`, `precio3`, `precio4`, `precio5`, `precio6`, `precio7`, `precio8`, `precio9`, `precio10`, `precio11`, `precio12`, `semanal1`, `semanal2`, `semanal3`, `semanal4`, `semanal5`, `semanal6`, `semanal7`, `semanal8`, `semanal9`, `semanal10`, `semanal11`, `semanal12`) VALUES  ('$cat','$prod','$qty','$precio','$p1','$p2','$p3','$p4','$p5','$p6','$p7','$p8','$p9','$p10','$p11','$p12','$s1','$s2','$s3','$s4','$s5','$s6','$s7','$s8','$s9','$s10','$s11','$s12')");
            $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$prod','$qty','Entrada de producto - Se agrego nueva producto')");

}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrgar Nuevo Producto</title>
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
#des{
    width: 500px;
    text-align: center;
}#qty{
    width: 80px;
    text-align: center;
}
</style>
</head>
<body>
    <div><small><a href="listaInv.php"><button>Atras</button></a></small></div>
    <div align="center"> 
        <h1>Ingrese la informacion completa</h1>
        <form action="agregar.php" method="POST" onsubmit="return valid();">
        <h2><label for="categ">Categoria</label>
        <select name="categ" id="categ">
            <option value=""></option>
           <?php $qrycat=mysqli_query($con,"SELECT DISTINCT category FROM inventario");
           while($row=mysqli_fetch_array($qrycat)){
            $cat=$row['category']; ?>
            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
          <?php } ?>
          <option value="Nueva"> Nuevo producto </option>
        </select></h2>
        <h2><label for="pro">Producto</label>
    <input type="text" name="pro" id="pro" placeholder="Spring air king size"></h2>
    
        <h2><label for="qty">Cantidad a ingresar</label>
    <input type="number" name="qty" id="qty" value="0" min="0" required></h2>
    <h2><label for="prec">Precio</label>
<input type="number" name="prec" id="prec" value="0" min="0" required></h2>
<input type="submit" name="guard" id="guard" value="Guardar">
        </form>
    </div>
</body>
</html>
<script>
    function valid(){
        var cat= document.getElementById("categ").value;
        var prod=document.getElementById("pro").value;
        var descrip= document.getElementById("des").value;
        var qty =document.getElementById("qty").value;
        var precio=document.getElementById("prec").value;

        if(cat=="" || prod=="" || descrip=="" || qty==0 || precio==0 ){
            alert("Falta informacion por completar");
            return false;
        }

    }
</script>

<?php } ?>