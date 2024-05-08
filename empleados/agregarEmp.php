<?php 
require "../app/conection.php";

$empleado=isset($_POST['nombre'])?$_POST['nombre']:"";
$empleado=strtoupper($empleado);
$numEmp=isset($_POST['numemp'])?$_POST['numemp']:"";
$numEmp=strtoupper($numEmp);
$puestoEmp=isset($_POST['puesto'])?$_POST['puesto']:"";
$puestoEmp=strtoupper($puestoEmp);


if( $empleado!="" and $numEmp!="" and $puestoEmp!=""){
    $insertar=mysqli_query($con,"INSERT INTO `personal`(`nombre`, `numEmp`, `puesto`) VALUES ('$empleado','$numEmp','$puestoEmp')");
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
</head>
<style>
         body{
        width: 100%;
        background-color: blanchedalmond;
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
#nombre{
    width: 250px;
}
#numemp{
    text-align: center;
    align-items: center;
    width: 90px;
}
</style>
<body>
<div><small><a href="index.php"><button>Atras</button></a></small></div>
<div align="center">
     <h1>Agregar empleado</h1>
    <br><br><br>
        <table>
            <thead>
               <th><h1>Nombre</h1></th>
               <th><h1>Numero de empleado</h1></th>
               <th><h1>puesto</h1></th>
               <th><h1>Guardar</h1></th>
              
            </thead>
            <tbody>
               <tr>
                    <form action="agregarEmp.php" method="POST">
                <td><input type="text" name="nombre" id="nombre"  required ></td>
                <td><input type="number" name="numemp" id="numemp"  required></td>
                <td><input type="text" name="puesto" id="puesto"  required></td>
                <td>
                   
                    <input type="submit" name="enviar" id="enviar" value="guardar">
                </form></td>
                
                </tr>
                
            </tbody>
        </table>
    
    
    
    </div>
</body>
</html>