<?php
session_start();
require "../app/conection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // To prevent SQL injection
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $sql = "SELECT * FROM login WHERE user = '$username' AND clave = '$password'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    
    if ($count == 1) {
        $log = "login";
        $_SESSION['usuario'] = $username; // Store the username in the session

        date_default_timezone_set('America/Mexico_City');
        $fecha = date('d-m-Y H:i');
        $registro = "INSERT INTO `registros`( `fecha`, `userName`, `action`) VALUES ('$fecha', '$username', '$log')";

        mysqli_query($con, $registro); // Insert the login record into the 'registros' table

        header("location: ../app/respbd.php");
    } else {
        header("location: ../index.html");
    }
} elseif (isset($_SESSION['usuario'])) {
    $username = $_SESSION['usuario'];

    $log = "logout"; // Assuming this is a logout action
    date_default_timezone_set('America/Mexico_City');
    $fecha = date('d-m-Y H:i');
    $registro = "INSERT INTO `registros`( `fecha`, `userName`, `action`) VALUES ( '$fecha', '$username', '$log')";

    mysqli_query($con, $registro); // Insert the logout record into the 'registros' table

    session_destroy(); // Destroy the session

    header("location: ../index.html");
} else {
    header("location: ../index.html"); // Redirect if not a POST request and no session user
}

mysqli_close($con);
?>