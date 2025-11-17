<?php
header('Content-Type: application/json');
include("conexion.php");


if (!isset($_GET['id_cancha'])) {
    echo json_encode(['error' => 'No se proporcionó el ID de la cancha.']);
    exit;
}

$id_cancha = intval($_GET['id_cancha']);


$query = "SELECT id_horario, horario, disponible FROM horario_cancha WHERE id_cancha = ?";
$stmt = mysqli_prepare($conexion, $query);

mysqli_stmt_bind_param($stmt, "i", $id_cancha);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$horarios = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $horarios[] = $fila;
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);


echo json_encode($horarios);
?>