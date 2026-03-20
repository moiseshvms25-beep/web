<?php
include("conexion.php");

$id = $_GET['id'];

// 1. Obtener el reporte original
$sql = "SELECT * FROM reportes WHERE id = $id";
$result = mysqli_query($conexion, $sql);
$reporte = mysqli_fetch_assoc($result);

if ($reporte) {

    // 2. Insertar los datos en la tabla archive
    $insert = "INSERT INTO archive (id_original, usuario, descripcion, fecha)
               VALUES ('{$reporte['id']}', '{$reporte['usuario']}', '{$reporte['descripcion']}', '{$reporte['fecha']}')";
    mysqli_query($conexion, $insert);

    // 3. Eliminar el reporte original SOLO después de archivarlo
    $delete = "DELETE FROM reportes WHERE id = $id";
    mysqli_query($conexion, $delete);

    echo "<script>alert('Reporte archivado correctamente'); window.location='ver_reportes.php';</script>";
} else {
    echo "<script>alert('Reporte no encontrado'); window.location='ver_reportes.php';</script>";
}

?>
