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

/* ================= CONSULTAS ================= */

// Pagos
$sql = "SELECT * FROM pagos ORDER BY fecha DESC";
$result = $conexion->query($sql);

// Total general
$totalGeneral = $conexion->query(
    "SELECT SUM(cantidad) AS total FROM pagos"
)->fetch_assoc()['total'] ?? 0;

// Total por usuario
$totalUsuarios = $conexion->query(
    "SELECT usuario, SUM(cantidad) AS total 
     FROM pagos GROUP BY usuario"
);

// Total por método
$totalMetodos = $conexion->query(
    "SELECT metodo, SUM(cantidad) AS total 
     FROM pagos GROUP BY metodo"
);

// Total por fecha
$totalFechas = $conexion->query(
    "SELECT DATE(fecha) AS fecha, SUM(cantidad) AS total 
     FROM pagos GROUP BY DATE(fecha) 
     ORDER BY fecha DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ver Pagos | Mega-Red</title>
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

        nav {
            background: #007bff;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        .contenedor {
            width: 95%;
            max-width: 1100px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        h2, h3 {
            text-align: center;
            color: #0044aa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .bloque {
            margin-top: 40px;
        }

        .total-general {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin: 20px 0;
        }

        .volver {
            text-align: center;
            margin-top: 30px;
        }

        .volver a {
            color: #0044aa;
            font-size: 18px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<header><i class="bi bi-cash-coin"></i> Pagos Registrados</header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="crud_usuarios/index.php">Usuarios</a>
    <a href="ver_reportes.php">Reportes</a>
    <a href="ver_pagos.php">Pagos</a>
</nav>

<div class="contenedor">

    <h2>Listado de Pagos</h2>

    <div class="total-general">
        💰 Total Recaudado: $<?php echo number_format($totalGeneral, 2); ?>
    </div>

    <!-- TABLA PRINCIPAL -->
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Cantidad</th>
                <th>Método</th>
                <th>Fecha</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td>$<?= number_format($row['cantidad'], 2) ?></td>
                    <td><?= htmlspecialchars($row['metodo']) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">No hay pagos registrados.</p>
    <?php endif; ?>

    <!-- TOTAL POR USUARIO -->
    <div class="bloque">
        <h3>Total por Usuario</h3>
        <table>
            <tr><th>Usuario</th><th>Total</th></tr>
            <?php while($u = $totalUsuarios->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($u['usuario']) ?></td>
                    <td>$<?= number_format($u['total'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- TOTAL POR MÉTODO -->
    <div class="bloque">
        <h3>Total por Método de Pago</h3>
        <table>
            <tr><th>Método</th><th>Total</th></tr>
            <?php while($m = $totalMetodos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($m['metodo']) ?></td>
                    <td>$<?= number_format($m['total'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- TOTAL POR FECHA -->
    <div class="bloque">
        <h3>Total por Fecha</h3>
        <table>
            <tr><th>Fecha</th><th>Total</th></tr>
            <?php while($f = $totalFechas->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($f['fecha']) ?></td>
                    <td>$<?= number_format($f['total'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="volver">
        <a href="index.php"><i class="bi bi-arrow-left-circle"></i> Regresar</a>
    </div>

</div>

</body>
</html>
