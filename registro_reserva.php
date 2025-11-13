<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

// 1. Validar y recoger los datos que vienen por POST desde el calendario
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

    
// creacion del id_pago
$sql_pago = "INSERT INTO pagos (id_pago) VALUES (null)";
$stmt_insert = mysqli_prepare($conexion, $sql_pago);
 mysqli_stmt_execute($stmt_insert);
$id_pago = mysqli_stmt_insert_id($stmt_insert);
mysqli_stmt_close($stmt_insert);


// 2. Preparar los datos restantes para la inserción
$id_usuario = $_SESSION['id_usuario'] ?? 0; 

// Se omite la columna 'estado' para que la base de datos use su valor por defecto.
$sql = "INSERT INTO reservas (id_cancha, id_usuario, id_pago, telefono, fecha_reserva, hora_inicio, hora_fin, nombre)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_insert = mysqli_prepare($conexion, $sql);

if ($stmt_insert === false) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($conexion)]);
    exit;
}

mysqli_stmt_bind_param($stmt_insert, "iiisssis", $id_cancha, $id_usuario, $id_pago, $telefono, $fecha_reserva, $hora_inicio, $hora_fin, $nombre_cliente);


if (mysqli_stmt_execute($stmt_insert)) {
    $id_reserva_creada = mysqli_insert_id($conexion);
    echo json_encode(['success' => true, 'id_reserva' => $id_reserva_creada]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la reserva: ' . mysqli_stmt_error($stmt_insert)]);
}
mysqli_stmt_close($stmt_insert);
mysqli_close($conexion);
?>
