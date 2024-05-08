<?php 
require "../app/conection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
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
    </style>
</head>
<body>
    <div><small><a href="../principal.php"><button>Home</button></a></small></div>
     <div align="center">
     <h1>Lista de empleados</h1>
    <br><br><br>
        <table>
            <thead>
               <th><h1>Nombre</h1></th>
               <th><h1>Numero de empleado</h1></th>
               <th><h1>puesto</h1></th>
               <th><h1>Editar</h1></th>
            </thead>
            <tbody>
                <?php
                $selectEmp=mysqli_query($con,"SELECT * FROM personal ");
                While($row=mysqli_fetch_array($selectEmp)){
                    $id=$row['id'];
                    $nomber=$row['nombre'];
                    $numEmp=$row['numEmp'];
                    $puesto=$row['puesto']; 
                ?><tr>
                <td><?php echo $nomber;?></td>
                <td><?php echo $numEmp;?></td>
                <td><?php echo $puesto;?></td>
                <td><form action="editarEmp.php" method="POST">
                    <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="enviar" id="enviar" value="Editar">
                </form></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <br><br><br>
    <div><a href="agregarEmp.php"><button>Agregar un nuevo empleado</button></a></div>
    
    </div>

</body>
</html>