<?php
require "app/conection.php";

// Obtener todos los productos con su ID, ordenados
$buscarArticulo = mysqli_query($con, "SELECT id, category, product FROM inventario WHERE product LIKE '%%-2025' ORDER BY product ASC, id DESC");

$recoleccion = [];

while ($row = mysqli_fetch_array($buscarArticulo)) {
    $id = $row['id'];
    $category = $row['category'];
    $product = $row['product'];

    if (isset($recoleccion[$product])) {
        // Si el producto ya existe en el array, elimina este registro (ID más bajo)
        mysqli_query($con, "DELETE FROM inventario WHERE id='$id'");
    } else {
        // Guarda solo el primer (ID más alto) en el array
        print($id . "-" . $category . "-" . $product . "<br>");
        $recoleccion[$product] = $id;
    }
}
?>
