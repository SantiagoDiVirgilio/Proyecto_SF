<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

// 1. Validar y recoger los datos que vienen por POST desde el calendario
$id_reserva = filter_input(INPUT_POST, 'id_reserva', FILTER_VALIDATE_INT);
$preference_id = filter_input(INPUT_POST, 'preference_id', FILTER_SANITIZE_STRING);

if (!$id_reserva || !$preference_id) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar la reserva.']);
    exit;
}
mysqli_begin_transaction($conexion);

try {
    // 1. Obtener el id_pago desde la tabla de reservas
    $sql_get_pago = "SELECT id_pago FROM reservas WHERE id_reserva = ?";
    $stmt_get_pago = mysqli_prepare($conexion, $sql_get_pago);
    mysqli_stmt_bind_param($stmt_get_pago, "i", $id_reserva);
    mysqli_stmt_execute($stmt_get_pago);
    $resultado_pago = mysqli_stmt_get_result($stmt_get_pago);
    $fila_pago = mysqli_fetch_assoc($resultado_pago);
    $id_pago = $fila_pago['id_pago'] ?? null;
    mysqli_stmt_close($stmt_get_pago);
    
    if (!$id_pago) {
        throw new Exception('No se encontró un pago asociado a la reserva.');
    }

    // 2. Actualizar el registro existente en la tabla 'pagos' con el id_preference
    $sql_update_pago = "UPDATE pagos SET id_preference = ? WHERE id_pago = ?";
    $stmt_update = mysqli_prepare($conexion, $sql_update_pago);
    if ($stmt_update === false) {
        throw new Exception('Error al preparar la consulta de actualización de pago: ' . mysqli_error($conexion));
    }
    mysqli_stmt_bind_param($stmt_update, "si", $preference_id, $id_pago);
    mysqli_stmt_execute($stmt_update);
    mysqli_stmt_close($stmt_update);
    mysqli_commit($conexion);
    echo json_encode(['success' => true, 'id_pago' => $id_pago, 'id_reserva' => $id_reserva]);

} catch (Exception $e) {
    // Si algo falló, revertir la transacción
    mysqli_rollback($conexion);
    echo json_encode(['success' => false, 'message' => 'Error al procesar el pago: ' . $e->getMessage()]);
}

mysqli_close($conexion);
?>