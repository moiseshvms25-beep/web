<?php
include("conexion.php");

$id      = $_POST['id'];
$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$stmt = $conexion->prepare("UPDATE usuarios SET usuario=?, clave=? WHERE id=?");
$stmt->bind_param("ssi", $usuario, $clave, $id);

$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
