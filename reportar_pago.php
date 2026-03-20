<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

// Guardar pago
$mensaje = "";

if (isset($_POST['registrar'])) {

    $usuario = $_SESSION['usuario'];
    $cantidad = $_POST['cantidad'];
    $metodo = $_POST['metodo'];

    $sql = "INSERT INTO pagos(usuario, cantidad, metodo, fecha)
            VALUES('$usuario', '$cantidad', '$metodo', NOW())";

    if ($conexion->query($sql)) {
        $mensaje = "Pago registrado correctamente.";
    } else {
        $mensaje = "Error al registrar pago: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reportar Pago | Mega-Red</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e8eef7;
            margin: 0;
        }

        header {
            background: #0044aa;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
        }

        .contenedor {
            width: 450px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #0044aa;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #aaa;
        }

        .btn {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            border-radius: 8px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .mensaje {
            background: #28a745;
            padding: 12px;
            margin-bottom: 15px;
            color: white;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        .volver {
            text-align: center;
            margin-top: 10px;
        }

        .volver a {
            color: #0044aa;
            text-decoration: none;
            font-size: 18px;
        }

    </style>
</head>

<body>

<header><i class="bi bi-cash-coin"></i> Reportar Pago</header>

<div class="contenedor">

    <?php if ($mensaje != "") { echo "<div class='mensaje'>$mensaje</div>"; } ?>

    <form method="POST">

        <label>Usuario</label>
        <input type="text" value="<?php echo $_SESSION['usuario']; ?>" disabled>

        <label>Cantidad</label>
        <input type="number" name="cantidad" required>

        <label>Método de Pago</label>
        <select name="metodo" required>
            <option>Efectivo</option>
            <option>Transferencia</option>
            <option>Depósito</option>
            <option>Tarjeta</option>
        </select>

        <button class="btn" name="registrar">
            <i class="bi bi-check-circle"></i> Registrar Pago
        </button>

    </form>

    <div class="volver">
        <a href="usuarios.php"><i class="bi bi-arrow-left-circle"></i> Regresar al Inicio</a>
    </div>

</div>

</body>
</html>
