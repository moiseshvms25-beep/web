<?php
// CONEXIÓN A LA BASE DE DATOS
$conexion = new mysqli("localhost", "root", "", "plataforma_datos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// AGREGAR USUARIO
if (isset($_POST['guardar'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $conexion->query("INSERT INTO usuarios (usuario, clave) VALUES ('$usuario', '$clave')");
    header("Location: index.php");
    exit();
}

// ELIMINAR USUARIO
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conexion->query("DELETE FROM usuarios WHERE id=$id");
    header("Location: index.php");
    exit();
}

// ACTUALIZAR USUARIO
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $conexion->query("UPDATE usuarios SET usuario='$usuario', clave='$clave' WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px #ccc;
        }
        h2 {
            background: #0275d8;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 50%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button, .btn {
            padding: 8px 15px;
            background: #0275d8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover, .btn:hover {
            background: #025aa5;
        }
        .btn-danger {
            background: red;
        }
        .btn-danger:hover {
            background: darkred;
        }
        .volver {
            display: inline-block;
            background: #5cb85c;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .volver:hover {
            background: #449d44;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #0275d8;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Botón para volver al panel principal -->
    <a class="volver" href="http://localhost/plataforma-datos/index.php">⬅ Volver a la Plataforma</a>

    <h2>Agregar Usuario</h2>

    <form method="POST" action="">
        <label>Usuario:</label><br>
        <input type="text" name="usuario" required><br>

        <label>Clave:</label><br>
        <input type="password" name="clave" required><br><br>

        <button type="submit" name="guardar">Guardar</button>
    </form>

    <?php
    // SI SE SELECCIONÓ EDITAR, MOSTRAR FORMULARIO DE EDICIÓN
    if (isset($_GET['editar'])) {
        $idEditar = $_GET['editar'];
        $consulta = $conexion->query("SELECT * FROM usuarios WHERE id=$idEditar");
        $datos = $consulta->fetch_assoc();
    ?>

    <h2>Editar Usuario</h2>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">

        <label>Usuario:</label><br>
        <input type="text" name="usuario" value="<?php echo $datos['usuario']; ?>" required><br>

        <label>Clave:</label><br>
        <input type="password" name="clave" value="<?php echo $datos['clave']; ?>" required><br><br>

        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <?php } ?>

    <h2>Lista de Usuarios</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Clave</th>
            <th>Acciones</th>
        </tr>

        <?php
        $resultado = $conexion->query("SELECT * FROM usuarios");

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>
                    <td>".$fila['id']."</td>
                    <td>".$fila['usuario']."</td>
                    <td>".$fila['clave']."</td>
                    <td>
                        <a class='btn' href='?editar=".$fila['id']."'>Editar</a>
                        <a class='btn btn-danger' href='?eliminar=".$fila['id']."' onclick=\"return confirm('¿Eliminar usuario?');\">Eliminar</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay usuarios registrados.</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>
