<!DOCTYPE html>
<html lang="es">
<?php
session_start();
if(!$_SESSION['usuario']){
    header("location:index.html");
}else{
require "app/conection.php";
$ene=0;$feb=0;$mar=0;$abr=0;$may=0;$jn=0;$jl=0;$ago=0;$sep=0;$oc=0;$nov=0;$di=0;$tt=0;
$e='-01-'.$year;
$f='-02-'.$year;$ma='-03-'.$year;$ab='-04-'.$year;$my='-05-'.$year;
$jun='-06-'.$year;$jul='-07-'.$year;$ag='-08-'.$year;$se='-09-'.$year;
$oct='-10-'.$year;$no='-11-'.$year;$dic='-12-'.$year;

$eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$e'");
while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
    $ene=$ene+($precio);}$tt=$tt+$ene;
    $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$f'");
    while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
        $feb=$feb+($precio);}$tt=$tt+$feb;
        $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$ma'");
        while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
            $mar=$mar+($precio);}$tt=$tt+$mar;
            $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$ab'");
            while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                $abr=$abr+($precio);}$tt=$tt+$abr;
                $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$my'");
                while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                    $may=$may+($precio);}$tt=$tt+$may;
                    $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$jun'");
                    while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                        $jn=$jn+($precio);}$tt=$tt+$jn;
                        $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$jul'");
                        while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                            $jl=$jl+($precio);}$tt=$tt+$jl;
                            $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$ag'");
                            while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                                $ago=$ago+($precio);}$tt=$tt+$ago;
                                $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$se'");
                                while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                                    $sep=$sep+($precio);}$tt=$tt+$sep;
                                    $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$oct'");
                                    while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                                        $oc=$oc+($precio);}$tt=$tt+$oc;
                                        $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$no'");
                                        while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                                            $nov=$nov+($precio);}$tt=$tt+$nov;
                                            $eneq=mysqli_query($con,"SELECT * FROM historico WHERE fecha LIKE '%%$dic'");
                                            while($enero=mysqli_fetch_array($eneq)){    $precio=$enero['precio'];
                                                $di=$di+($precio);}$tt=$tt+$di;


$etiquetas=["ENERO","FEBERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE","TOTAL"];

$datosVentas = [$ene, $feb, $mar, $abr,$may,$jn,$jl,$ago,$sep,$oc,$nov,$di,$tt];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <div><small><a href="principal.php"><button>Atras</button></a></small></div>
    <h1 align="center"></div>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
        const etiquetas = <?php echo json_encode($etiquetas) ?>;
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const datosVentas2020 = {
            label: "Ventas por mes",
            // Pasar los datos igualmente desde PHP
            data: <?php echo json_encode($datosVentas) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        new Chart($grafica, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                    datosVentas2020,
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
     <footer>    <style>
        footer{            background-color: lightslategray;
            color: aliceblue;
            height: 40px;  
            align-items: center;
           width: 100%;                                }
            p{                font: bold italic            } 
            
    </style>    <p>Created by Jorge Garrido</p></footer>
</body>

</html>

<?php } ?>