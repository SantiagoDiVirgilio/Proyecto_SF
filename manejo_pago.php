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
    // Paso extra: Verificar si la reserva ya tiene un pago asociado
    $sql_check = "SELECT id_pago FROM reservas WHERE id_reserva = ?";
    $stmt_check = mysqli_prepare($conexion, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "i", $id_reserva);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $reserva_existente = mysqli_fetch_assoc($result_check);
    mysqli_stmt_close($stmt_check);

    if ($reserva_existente && $reserva_existente['id_pago'] !== null) {
        // Si ya existe un pago, no hacemos nada y devolvemos éxito para no interrumpir el flujo.
        throw new Exception('Esta reserva ya tiene un pago asociado (ID: ' . $reserva_existente['id_pago'] . ').');
    }

    // 2. Insertar un nuevo registro en la tabla 'pagos'
    $sql_pago = "INSERT INTO pagos (estado, id_preference) VALUES (?, ?)";
    $stmt_pago = mysqli_prepare($conexion, $sql_pago);
    if ($stmt_pago === false) {
        throw new Exception('Error al preparar la consulta de pago: ' . mysqli_error($conexion));
    }
    mysqli_stmt_bind_param($stmt_pago, "ss", $estado_pago, $preference_id);
    mysqli_stmt_execute($stmt_pago);

    // 3. Obtener el ID del pago recién creado
    $id_pago = mysqli_insert_id($conexion);
    mysqli_stmt_close($stmt_pago);

    if ($id_pago == 0) {
        throw new Exception('No se pudo crear el registro de pago.');
    }

    // 4. Actualizar la tabla 'reservas' con el nuevo id_pago
    $sql_reserva = "UPDATE reservas SET id_pago = ? WHERE id_reserva = ?";
    $stmt_reserva = mysqli_prepare($conexion, $sql_reserva);
    if ($stmt_reserva === false) {
        throw new Exception('Error al preparar la consulta de reserva: ' . mysqli_error($conexion));
    }
    mysqli_stmt_bind_param($stmt_reserva, "ii", $id_pago, $id_reserva);
    mysqli_stmt_execute($stmt_reserva);
    mysqli_stmt_close($stmt_reserva);

    // Si todo fue bien, confirmar la transacción
    mysqli_commit($conexion);
    echo json_encode(['success' => true, 'id_pago' => $id_pago]);

} catch (Exception $e) {
    // Si algo falló, revertir la transacción
    mysqli_rollback($conexion);
    echo json_encode(['success' => false, 'message' => 'Error al procesar el pago: ' . $e->getMessage()]);
}

mysqli_close($conexion);
?>