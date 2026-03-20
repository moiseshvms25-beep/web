<?php
include("conexion.php");

$id = $_GET['id'];

$resultado = $conexion->query("SELECT * FROM usuarios WHERE id=$id");
$fila = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Usuario</title>

<style>
    body {
        background: #1e1e1e;
        color: #ddd;
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    .container { width: 60%; margin: auto; background: #2c2c2c; padding: 20px; border-radius: 10px; }
    h1 { color: #4fa3ff; }
    input { width: 100%; padding: 10px; background: #333; border: 1px solid #555; border-radius: 5px; color: #fff; }
    button { background: #4fa3ff; color: #fff; padding: 10px; border: none; margin-top: 10px; border-radius: 5px; cursor: pointer; }
    a { color: #4fa3ff; }
</style>

</head>
<body>

<div class="container">
    <h1>Editar Usuario</h1>

    <form method="POST" action="editar_procesar.php">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?php echo $fila['usuario']; ?>" required>

        <label>Clave:</label>
        <input type="password" name="clave" value="<?php echo $fila['clave']; ?>" required>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="index.php">⬅ Volver</a>
</div>

</body>
</html>
