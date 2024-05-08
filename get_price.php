<?php
session_start();
require "app/conection.php";

$articulo = isset($_GET['articulo']) ? $_GET['articulo'] : '';
$plazo = isset($_GET['plazo']) ? $_GET['plazo'] : '';

$qry = mysqli_query($con, "SELECT * FROM inventario WHERE product = '$articulo'");
$products = array();

if ($qry) {
    $row = mysqli_fetch_assoc($qry);
    $precio = $row['precio' . $plazo];
    $semana = $row['semanal' . $plazo];

    echo json_encode(['precio' => $precio, 'semana' => $semana]);
} else {
    echo json_encode(['error' => 'Database query failed']);
}
?>