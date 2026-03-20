<?php
session_start();
include("conexion.php");


ini_set('display_errors', 1);
error_reporting(E_ALL);

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conexion, $_POST['password']);

   
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
    $result = mysqli_query($conexion, $sql);

    if (!$result) {
        die("Error SQL: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['clave'] === $clave) {

            
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['id_usuario'] = $row['id'];

            header("Location: usuarios.php");
            exit();

        } else {
            $mensaje = "Contraseña incorrecta";
        }

    } else {
        $mensaje = "El usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login | Mega-Red</title>

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #e8eef7;
            margin: 0;
        }

        header {
            background: #0044aa;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 26px;
            font-weight: bold;
        }

        .login-box {
            width: 380px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 18px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #0044aa;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #999;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }

        .mensaje {
            padding: 12px;
            background: #c62828;
            color: white;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
        }

        .footer a {
            color: #0044aa;
            text-decoration: none;
        }

    </style>
</head>

<body>

<header><i class="bi bi-person-circle"></i> Acceso a Mega-Red</header>

<div class="login-box">

    <?php if ($mensaje != "") { ?>
        <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php } ?>

    <h2>Iniciar Sesión</h2>

    <form action="" method="POST">

        <label>Usuario</label>
        <input type="text" name="usuario" required placeholder="Ingrese su usuario">

        <label>Contraseña</label>
        <input type="password" name="password" required placeholder="Ingrese su clave">

        <button class="btn" type="submit"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>

    </form>

    <div class="footer">
        <a href="index.php"><i class="bi bi-arrow-left-circle"></i> Regresar al inicio</a>
    </div>

</div>

</body>
</html>

