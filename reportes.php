<?php
include("conexion.php");

if(isset($_POST['enviar'])) {

    $usuario = $_POST['usuario'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO reportes (usuario, descripcion, fecha)
            VALUES ('$usuario', '$descripcion', NOW())";

    if (mysqli_query($conexion, $sql)) {
        $mensaje = "Reporte enviado correctamente.";
    } else {
        $mensaje = "Error al enviar reporte: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reportar Falla</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>Levantar Reporte de Falla</header>

<nav>
    <a href="usuarios.php">Regresar</a>
</nav>

<div class="content">

<?php if(isset($mensaje)) { echo "<p class='alert'>$mensaje</p>"; } ?>

<form method="POST">
    <label>Usuario:</label>
    <input type="text" name="usuario" required>

    <label>Descripción del problema:</label>
    <textarea name="descripcion" required></textarea>

    <button type="submit" name="enviar">Enviar Reporte</button>
</form>

</div>

</body>
</html>
