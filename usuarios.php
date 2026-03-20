<?php
session_start();

// Validación de sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel del Usuario - Mega-Red</title>
    <link rel="stylesheet" href="style.css">

    <!-- Librería de iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: Arial;
        }

        header {
            background: #0044aa;
            padding: 15px;
            color: white;
            font-size: 24px;
            text-align: center;
        }

        nav {
            margin: 20px auto;
            text-align: center;
        }

        nav a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 15px 25px;
            margin: 10px;
            text-decoration: none;
            border-radius: 10px;
            font-size: 18px;
            transition: 0.3s;
        }

        nav a:hover {
            background: #0056b3;
        }

        .content {
            text-align: center;
            margin-top: 40px;
        }

        .content h1 {
            font-size: 40px;
            color: #0044aa;
        }

        .content p {
            font-size: 20px;
        }
    </style>
</head>

<body>

<header></header>

<nav>
    <!-- OPCIÓN 1 -->
    <a href="reportes.php"><i class="bi bi-wifi-off"></i> Reportar falla en servicio</a>
    
    <!-- OPCIÓN 2 AGREGADA -->
    <a href="reportar_pago.php"><i class="bi bi-cash-coin"></i> Reportar Pago</a>

  

    <!-- CERRAR SESIÓN -->
    <a href="logout.php" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
    </a>
</nav>

<div class="content">
    <h1>Bienvenido a Mega-Red</h1>
    <p>Seleccione una opción</p>

    <img src="imagenes/cloud.png" alt="Imagen de servicios en la nube" style="width:80%; max-width:700px; margin-top:30px;">
</div>
