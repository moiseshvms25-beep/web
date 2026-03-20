<?php
session_start();
include "conexion.php";

$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
$resultado = mysqli_query($conexion, $query);

if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
} else {
    echo "<script>alert('Datos incorrectos'); window.location='login.php';</script>";
}
?>
