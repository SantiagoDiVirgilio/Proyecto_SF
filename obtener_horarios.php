<?php
header('Content-Type: application/json');
include("conexion.php");

// Verificar que se recibe el ID del deporte
if (!isset($_GET['id_deporte'])) {
    echo json_encode(['error' => 'No se proporcionó el ID del deporte.']);
    exit;
}

$id_deporte = intval($_GET['id_deporte']);

// Consultar los horarios para el ID de deporte específico
$query = "SELECT id_horario, horario, disponible FROM horario_cancha WHERE deporte = ?";
$stmt = mysqli_prepare($conexion, $query);
// "i" indica que el parámetro es un integer (número entero)
mysqli_stmt_bind_param($stmt, "i", $id_deporte);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$horarios = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $horarios[] = $fila;
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);

// Enviar los datos como JSON
echo json_encode($horarios);
?>