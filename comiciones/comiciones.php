<?php 
session_start();

if(!$_SESSION['usuario']){
    header("location:../index.html");
} else {
    require "../app/conection.php";
    date_default_timezone_set("America/Mexico_City");
    $fechade = isset($_POST['de']) ? $_POST['de'] : "";
    $fechaa = isset($_POST['a']) ? $_POST['a'] : "";
       
    if ($fechade != "" && $fechaa != "") {
      //  echo "De: " . $fechade . " a " . $fechaa;
        
        $fechade = strtotime(date("d-m-Y", strtotime($fechade)));
        $fechaa = strtotime(date("d-m-Y", strtotime($fechaa)));
        
      //  echo "<br>" . date("d-m-y", $fechade) . "<br>" . date("d-m-y", $fechaa) . "<br>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comiciones</title>
</head>
<style>
    body {
        width: 100%;
        background-color: blanchedalmond;
    }
    .title {
        font-size: xx-large;
        align-items: center;
        text-align: center;
    }
    .links {
        align-items: center;
        align-self: center;
        text-align: center;
        padding-top: 100px;
    }
    #btn {
        padding-right: 20px;
    }
    label {
        font: bold;
    }
    table {
        border: 2px lightslategray solid;
        width: 100%;
    }
    th {
        border: 1px lightblue solid;
    }
    td {
        align-items: center;
        text-align: center;
        border-bottom: 1px lightblue solid;
    }
</style>
<body>
    <div><small><a href="ventasPorEmpleado.php"><button>Atras</button></a></small></div>
    <div align="center">
        <h1>Comiciones por empleado</h1>
        <br>
        <form action="comiciones.php" method="POST">
            <label for="de">Buscar por fechas </label><input type="date" name="de" id="de" required>
            <label for="a">A</label> <input type="date" name="a" id="a" required>
            <input type="submit" name="buscar" id="buscar" value="buscar">
        </form>
        <br>

        <table>
            <thead>
                <tr>
                    <h2>Vendedores</h2>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Total de Venta</th>
                    <th>Comicion</th>
                    <th>Desglosado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $qryempleado = mysqli_query($con, "SELECT * FROM personal WHERE puesto='VENDEDOR'");
                while($row = mysqli_fetch_array($qryempleado)){
                    $vendedor = $row['nombre'];
                    $ventatt = 0;
                    $comit = 0;
                    $comis = 0;
                    $cuenta = 0;

                  
                        $qryvent = mysqli_query($con, "SELECT * FROM venta WHERE vendedor='$vendedor'");
                    

                    while($vv = mysqli_fetch_array($qryvent)){
                        $date = strtotime($vv['fecha']);
                        $ventas = $vv['precio'];
                        $art = $vv['articulo'];
                        $cantArt = $vv['cantArt'];
                        $cuenta = $vv['cuenta'];

                        if($fechade != "" && $fechaa != "" && $date >= $fechade && $date <= $fechaa){ 
                            $ventatt += $ventas;
                            $qrycomi = mysqli_query($con, "SELECT * FROM inventario WHERE product='$art'");
                            
                            while($comi = mysqli_fetch_array($qrycomi)){
                                $precont = $comi['CONTADO'];
                                $comis = (int)($cantArt * ($precont * 0.08));
                            }
                            $comit += $comis;
                        }
                    }
                ?>
                <tr>
                    <td><?php echo $vendedor; ?></td>
                    <td><?php echo $ventatt; ?></td>
                    <td><?php echo $comit; ?></td>
                    <td>
                        <form action="desglosado.php" method="POST">
                            <input type="hidden" name="vendedor" id="vendedor" value="<?php echo $vendedor; ?>">
                            <input type="hidden" name="fechade" id="fechade" value="<?php echo $fechade; ?>">
                            <input type="hidden" name="fechaa" id="fechaa" value="<?php echo $fechaa; ?>">
                            <input type="submit" name="enviar" id="enviar" value="Desglose de venta">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>
        <table>
            <thead>
                <tr>
                    <h2>Promotores</h2>
                </tr>
                <tr>
                    <th>Nombre</th>
                 
                    <th>Total de Venta</th>
                    <th>Comicion</th>
                    <th>Desblosado</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $qryempleado = mysqli_query($con, "SELECT * FROM personal WHERE puesto='PROMOTOR'");
                while($row = mysqli_fetch_array($qryempleado)){
                    $vendedor = $row['nombre'];
                    $ventatt = 0;
                    $comit = 0;
                    $comis = 0;
                    $cuenta = "";

                    
                        $qryvent = mysqli_query($con, "SELECT * FROM venta WHERE promotor='$vendedor'");
                    

                    while($vv = mysqli_fetch_array($qryvent)){
                        $date = strtotime($vv['fecha']);
                        $ventas = $vv['precio'];
                        $art = $vv['articulo'];
                        $cantArt = $vv['cantArt'];
                        $cuenta = $vv['cuenta'];

                        if($fechade != "" && $fechaa != "" && $date >= $fechade && $date <= $fechaa){
                            $ventatt += $ventas;
                            $qrycomi = mysqli_query($con, "SELECT * FROM inventario WHERE product='$art'");
                            
                            while($comi = mysqli_fetch_array($qrycomi)){
                                $precont = $comi['CONTADO'];
                                $comis = (int)($cantArt * (($precont - ($precont * 0.08)) * 0.05));
                            }
                            $comit += $comis;
                        }
                    }
                ?>
                <tr>
                    <td><?php echo $vendedor; ?></td>
                    
                    <td><?php echo $ventatt; ?></td>
                    <td><?php echo $comit; ?></td>
                    <td>
                        <form action="desglosado.php" method="POST">
                            <input type="hidden" name="vendedor" id="vendedor" value="<?php echo $vendedor; ?>">
                            <input type="hidden" name="fechade" id="fechade" value="<?php echo $fechade; ?>">
                            <input type="hidden" name="fechaa" id="fechaa" value="<?php echo $fechaa; ?>">
                            
                            <input type="submit" name="enviar" id="enviar" value="Desglose de venta">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php } ?>
