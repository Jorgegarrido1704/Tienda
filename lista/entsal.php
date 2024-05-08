<?php 
session_start();
require "../app/conection.php"
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
    
        <h1>Entradas y salidas</h1>
        
        <table>
        <Thead>
            <th><h2>Fecha</h2></th>
            <th><h2>Producto</h2></th>
           
            <th><h2>cantidad</h2></th>
            <th><h2>Concepto</h2></th>
           
        </Thead>
        <tbody>
            <?php 
           $qry=mysqli_query($con,"SELECT * FROM ensal ");
            while($row=mysqli_fetch_array($qry)){
                $id=$row['id'];
                $art=$row['producto'];
                $fec=$row['fecha'];
                
                $qty=$row['cantidad'];
                $price=$row['concepto'];
                ?>
                <tr>
                    <td><h2><?php echo $fec; ?></h2></td>
                    <td><h2><?php echo $art; ?></h2></td>
                    <td><h2><?php echo $qty; ?></h2></td>
                    <td><h2><?php echo $price; ?></h2></td>
                 
                </tr>
                <?php } ?>
        </tbody>
    </table>
    
    </div>
</body>
</html>


