<?php 
require "../app/conection.php";
$id_emp=isset($_POST['id'])?$_POST['id']:"";
$empleado=isset($_POST['nombre'])?$_POST['nombre']:"";
$empleado=strtoupper($empleado);
$numEmp=isset($_POST['numemp'])?$_POST['numemp']:"";
$numEmp=strtoupper($numEmp);
$puestoEmp=isset($_POST['puesto'])?$_POST['puesto']:"";
$puestoEmp=strtoupper($puestoEmp);
$cancelar=isset($_POST['cancel'])?$_POST['cancel']:"";

//echo $id_emp;
if($id_emp!="" and $empleado!="" and $numEmp!="" and $puestoEmp!=""){
    $update=mysqli_query($con,"UPDATE personal SET nombre='$empleado',numEmp='$numEmp',puesto='$puestoEmp' WHERE id='$id_emp'");

}
if($cancelar!=""){
    $delete=mysqli_query($con,"DELETE FROM personal WHERE id='$id_emp'");
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
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
</style>
<body>
<div><small><a href="index.php"><button>Atras</button></a></small></div>
<div align="center">
     <h1>Lista de empleados</h1>
    <br><br><br>
        <table>
            <thead>
               <th><h1>Nombre</h1></th>
               <th><h1>Numero de empleado</h1></th>
               <th><h1>puesto</h1></th>
               <th><h1>Editar</h1></th>
               <th><h1>Eliminar</h1></th>
            </thead>
            <tbody>
                <?php
                $selectEmp=mysqli_query($con,"SELECT * FROM personal WHERE id='$id_emp' ");
                While($row=mysqli_fetch_array($selectEmp)){
                    $id=$row['id'];
                    $nomber=$row['nombre'];
                    $numEmp=$row['numEmp'];
                    $puesto=$row['puesto']; 
                ?><tr>
                    <form action="editarEmp.php" method="POST">
                <td><input type="text" name="nombre" id="nombre" value="<?php echo $nomber;?>" required ></td>
                <td><input type="number" name="numemp" id="numemp" value="<?php echo $numEmp;?>" required></td>
                <td><input type="text" name="puesto" id="puesto" value="<?php echo $puesto;?>" required></td>
                <td>
                    <input type="hidden" id="id" name="id" value="<?php echo $id_emp;?>">
                    <input type="submit" name="enviar" id="enviar" value="guardar">
                </form></td>
                <td>
                        <form action="editarEmp.php" method="POST">
                      <input type="hidden" name="cancel" id="cancel" value="cancel"> 
                        <input type="hidden" id="id" name="id" value="<?php echo $id_emp;?>">
                        <input type="submit" name="enviar" id="enviar" value="Eliminar">
                        </form>
                </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    
    
    
    </div>
</body>
</html>