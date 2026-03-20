<?php
$conexion = mysqli_connect("localhost", "root", "", "plataforma_datos");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

