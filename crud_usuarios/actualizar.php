<?php
include("conexion.php");

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

mysqli_query($conexion, "UPDATE usuarios SET usuario='$usuario', clave='$clave' WHERE id=$id");

header("Location: index.php");
?>
