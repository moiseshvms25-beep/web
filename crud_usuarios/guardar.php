<?php
include("conexion.php");

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql = "INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$clave')";
mysqli_query($conexion, $sql);

header("Location: index.php");
exit();
?>
