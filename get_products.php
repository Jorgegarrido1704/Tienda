<?php 
session_start();
require "app/conection.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $qry = mysqli_query($con, "SELECT id, product FROM inventario WHERE category = '$category'");
    $products = array();

    if ($qry) {
        while ($row = mysqli_fetch_assoc($qry)) {
            $products[] = $row;
        }
        echo json_encode($products);
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
}

?>