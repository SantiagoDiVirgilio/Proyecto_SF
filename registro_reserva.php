<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");


$nombre_cliente = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$fecha_reserva = $_POST['fecha_reserva'] ?? null;
$hora_inicio = $_POST['hora_inicio'] ?? null;
$hora_fin = $_POST['hora_fin'] ?? null;
$id_cancha = $_POST['id_cancha'] ?? null;

if (!$nombre_cliente || !$telefono || !$fecha_reserva || $hora_inicio === null || $hora_fin === null || !$id_cancha) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar la reserva.']);
    exit;
}
mysqli_begin_transaction($conexion);

try {

    $estado_pago_inicial = 'Pendiente';
    $sql_pago = "INSERT INTO pagos (estado) VALUES (?)";
    $stmt_pago = mysqli_prepare($conexion, $sql_pago);
    if ($stmt_pago === false) {
        throw new Exception('Error al preparar la consulta de pago: ' . mysqli_error($conexion));
    }
    mysqli_stmt_bind_param($stmt_pago, "s", $estado_pago_inicial);
    mysqli_stmt_execute($stmt_pago);
    $id_pago = mysqli_insert_id($conexion);
    mysqli_stmt_close($stmt_pago);

    if ($id_pago == 0) {
        throw new Exception('No se pudo crear el registro de pago.');
    }

    $id_usuario = $_SESSION['id_usuario'] ?? 0; 

    
    $sql_reserva = "INSERT INTO reservas (id_cancha, id_usuario, id_pago, telefono, fecha_reserva, hora_inicio, hora_fin, nombre)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_reserva = mysqli_prepare($conexion, $sql_reserva);
    if ($stmt_reserva === false) {
        throw new Exception('Error al preparar la consulta de reserva: ' . mysqli_error($conexion));
    }
    mysqli_stmt_bind_param($stmt_reserva, "iiisssis", $id_cancha, $id_usuario, $id_pago, $telefono, $fecha_reserva, $hora_inicio, $hora_fin, $nombre_cliente);

    if (mysqli_stmt_execute($stmt_reserva)) {
        $id_reserva_creada = mysqli_insert_id($conexion);
        mysqli_stmt_close($stmt_reserva);
        mysqli_commit($conexion); 
        echo json_encode(['success' => true, 'id_reserva' => $id_reserva_creada, 'id_pago' => $id_pago]);
    } else {
        throw new Exception('Error al registrar la reserva: ' . mysqli_stmt_error($stmt_reserva));
    }
} catch (Exception $e) {
    mysqli_rollback($conexion); 
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

mysqli_close($conexion);
?>
