<?php 
session_start();
if(!$_SESSION['usuario']){
    header("location:../index.html");
}else{
require "../app/conection.php";
$category=isset($_POST['cate'])?$_POST['cate']:"";
$product=isset($_POST['busprod'])?$_POST['busprod']:"";
$cambioProd=isset($_POST['prod'])?$_POST['prod']:"";
$new=isset($_POST['ncan'])?$_POST['ncan']:"";
$newp=isset($_POST['pre'])?$_POST['pre']:"";
date_default_timezone_set("America/Mexico_City");
$date=date("d-m-Y H:i");
//echo $category.$product.$cambioProd.$new;
if($new!=""){
    $buscarprod=mysqli_query($con,"SELECT qty FROM inventario WHERE product='$cambioProd'");
    while($row=mysqli_fetch_array($buscarprod)){
        $proqt=$row['qty'];
        if($proqt>$new){
            $tprod=$proqt-$new;
            $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$cambioProd','$tprod','Salida de producto - inventario')");
        }else  if($proqt<$new){
            $tprod=$new-$proqt;
            $instlista=mysqli_query($con,"INSERT INTO `ensal`( `fecha`, `producto`, `cantidad`, `concepto`) VALUES ('$date','$cambioProd','$tprod','Entrada de producto - inventario')");
        }
    }
    $update=mysqli_query($con,"UPDATE inventario SET qty='$new' WHERE product='$cambioProd'");
}if($newp!=""){
    $update=mysqli_query($con,"UPDATE inventario SET price='$newp' WHERE product='$cambioProd'");
}

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
}</style>
</head>
<body>
    <div><small><a href="../principal.php"><button>Atras</button></a></small></div>

    <div align="center">
    <a href="agregar.php"><button>Agregar un nuevo producto</button></a>    
    
        <h1>Lista de productos</h1>
        <form action="listaInv.php" method="POST">
        <label for="busprod"><h2>Buscar por producto</label><input type="text" name="busprod" id="busprod">
        <label for="busprod">Buscar por Categoria</label><input type="text" name="cate" id="cate">
        <input type="submit" name="busc" id="busc" value="Buscar"></h2>

        </form>
        <table>
        <Thead>
            <th><h2>Categoria</h2></th>
            <th><h2>Producto</h2></th>
           
            <th><h2>Cantidad en inventario</h2></th>
            <th><h2>Precio contado</h2></th>
            <th><h2>Modificar</h2></th>
        </Thead>
        <tbody>
            <?php 
            if($category!="" and $product!=""){ $qry=mysqli_query($con,"SELECT * FROM inventario WHERE category LIKE '%%$category%%' and product LIKE '%%$product%%'");}
           else if( $product!=""){ $qry=mysqli_query($con,"SELECT * FROM inventario WHERE product LIKE '%%$product%%'");}
            else if($category!="" ){ $qry=mysqli_query($con,"SELECT * FROM inventario WHERE category LIKE '%%$category%%'");}else{
            $qry=mysqli_query($con,"SELECT * FROM inventario ");}
            while($row=mysqli_fetch_array($qry)){
                $id=$row['id'];
                $cat=$row['category'];
                $prod=$row['product'];
                
                $qty=$row['qty'];
                $price=$row['CONTADO'];
                ?>
                <tr>
                    <td><h2><?php echo $cat; ?></h2></td>
                    <td><h2><?php echo $prod; ?></h2></td>
                    
                    <td><h2><?php echo $qty; ?></h2>
                    <!--<form action="listaInv.php" method="POST"  id="cantpro">
                        <input type="hidden" name="prod" id="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="ncan" id="ncan">
                        <input type="submit" name="cambio" id="cambio" value="Modificar"></form></td>
                    <td><h2><?php echo $price; ?></h2><form action="listaInv.php" method="POST"  id="precios">
                        <input type="hidden" name="prod" id="prod" value="<?php echo $prod; ?>">
                        <input type="hidden" name="pre" id="pre">
                        <input type="submit" name="cambio" id="cambio" value="Modificar"></form></td>-->
                        <td><h2><?php echo $price;?></h2></td>
                        <td><form action="modificar.php" method="POST">
                          <h2>  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            <input type="submit" name="enviar" id="enviar" value="Modificar"></h2>
                        </form></td>
                </tr>
                <?php } ?>
        </tbody>
    </table>
    
    </div>
</body>
</html>
<script>
    /*document.forms[1].onsubmit = function (){
        var cantiN = prompt("Ingrese la cantidad nueva: ");
        if (parseInt(cantiN) && parseInt(cantiN) > 0){
            document.getElementById('ncan').value=cantiN;
            return true;
        } else {
            alert("Por favor, ingrese una cantidad válida mayor que cero.");
            return false;
        }
    }
    document.forms[2].onsubmit = function (){
        var cantiN = prompt("Ingrese la cantidad nueva: ");
        if (parseInt(cantiN) && parseInt(cantiN) > 0){
            document.getElementById('pre').value=cantiN;
            return true;
        } else {
            alert("Por favor, ingrese una cantidad válida mayor que cero.");
            return false;
        }
    }*/
</script>

<?php } ?>