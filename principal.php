<?php 
session_start();
if($_SESSION['usuario']){
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
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
    padding-top: 50px;
}
#btn{
    
    padding-right: 20px;
}
</style>
<body>
    <div><a href="log/logout.php"><button>Cerrar sesion</button></a></div>
    <div class="title"> <h2>"Fabrica de muebles La Española"</h2></div>

    <div class="links">
    <a href="ventas.php" id="btn"><button><h2>Punto de venta</h2></button></a>
    <a href="abonos/clientes.php" id="btn"><button><h2>Clientes</h2></button></a>
    <a href="pagadas.php" id="btn"><button><h2>Ventas liquidadas</h2></button></a>
    <a href="cancelacion/cancelacion.php" id="btn"><button><h2>Cancelaciones</h2></button></a>
    <a href="bonificacion/index.php" id="btn"><button><h2>Bonificacion</h2></button></a>
    
</div>

<div class="links">
<a href="lista/listaInv.php" id="btn"><button><h2>Inventario</h2></button></a>
<a href="lista/entsal.php" id="btn"><button><h2>Entradas y Salidas</h2></button></a>
    <a href="factu.php" id="btn"><button><h2>Facturacíon del mes</h2></button></a>
    <a href="comiciones/ventasPorEmpleado.php" id="btn"><button><h2>Ventas por empleado</h2></button></a>
    <a href="graficas.php" id="btn"><button><h2>Graficas de ventas</h2></button></a>
       
    </div>
    <div class="links">
    <a href="empleados/index.php" id="btn"><button><h2>Empleados</h2></button></a>
    <a href="rep/Reportes.php" id="btn"><button><h2>Reportes</h2></button></a>
</div>
</body>
</html>
<?php }else{
    header("location:index.html");
}