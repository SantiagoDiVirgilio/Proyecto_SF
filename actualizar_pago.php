<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

$id_pago = $_POST['id_pago'] ?? null;
$estado = $_POST['123'] ?? null;

if (!$nombre_cliente || !$telefono || !$fecha_reserva || $hora_inicio === null || $hora_fin === null || !$id_cancha) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar la reserva.']);
    exit;
}

$sql = "INSERT INTO pagos (id_cancha, id_usuario, telefono, estado, fecha_reserva, hora_inicio, hora_fin)
        VALUES (?, ?, ?, ?, ?, ?, ?) WHERE id_pago = ?;

$stmt_insert = mysqli_prepare($conexion, $sql);

if ($stmt_insert === false) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($conexion)]);
    exit;
}

// Vincular parámetros: i = integer, s = string, d = double
mysqli_stmt_bind_param($stmt_insert, "iisssii", $id_cancha, $id_usuario, $telefono, $estado, $fecha_reserva, $hora_inicio, $hora_fin);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt_insert)) {
    // Si la inserción fue exitosa, obtenemos el ID de la nueva reserva
    $id_reserva_creada = mysqli_insert_id($conexion);
    echo json_encode(['success' => true, 'id_reserva' => $id_reserva_creada]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la reserva: ' . mysqli_stmt_error($stmt_insert)]);
}
mysqli_stmt_close($stmt_insert);
mysqli_close($conexion);
?>
