<?php
include("conexion.php");

$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$stmt = $conexion->prepare("INSERT INTO usuarios(usuario, clave) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $clave);

$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
