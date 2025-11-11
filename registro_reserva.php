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
$id_pago = $_POST['id_pago'] ?? null;
$monto = $_POST['monto'] ?? null;

if (!$nombre_cliente || !$telefono || !$fecha_reserva || $hora_inicio === null || $hora_fin === null || !$id_cancha) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar la reserva.']);
    exit;
}

// 2. Preparar los datos restantes para la inserción
$id_usuario = $_SESSION['id_usuario'] ?? 0; // Usar 0 si el usuario no está logueado
$estado = 'Reservado'; // Un estado inicial antes del pago

// 3. Insertar la reserva en la base de datos
// La tabla `reservas` no tiene `nombre_cliente`, así que no lo insertamos.
// El nombre se puede obtener con un JOIN a la tabla `usuarios` si es necesario.
$sql = "INSERT INTO reservas (id_cancha, id_usuario, id_pago, telefono, estado, fecha_reserva, monto, hora_inicio, hora_fin) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_insert = mysqli_prepare($conexion, $sql);

if ($stmt_insert === false) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($conexion)]);
    exit;
}

// Vincular parámetros: i = integer, s = string, d = double
mysqli_stmt_bind_param($stmt_insert, "iiisssdii", $id_cancha, $id_usuario, $id_pago, $telefono, $estado, $fecha_reserva, $monto, $hora_inicio, $hora_fin);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt_insert)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar la reserva: ' . mysqli_stmt_error($stmt_insert)]);
}
mysqli_stmt_close($stmt_insert);
mysqli_close($conexion);
?>
