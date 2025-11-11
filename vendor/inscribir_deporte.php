<?php
session_start();
include 'conexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit;
}

if (!isset($_POST['id_deporte'])) {
    echo json_encode(['success' => false, 'message' => 'ID de deporte no proporcionado.']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_deporte = $_POST['id_deporte'];
$fecha_inscripcion = time();
$becado = 0;

// Verificar si el usuario ya está inscripto
$stmt_check = $conexion->prepare("SELECT id_inscripcion FROM inscripciones WHERE id_usuario = ? AND id_deporte = ?");
$stmt_check->bind_param("ii", $id_usuario, $id_deporte);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Ya estás inscripto en este deporte.']);
    $stmt_check->close();
    $conexion->close();
    exit;
}
$stmt_check->close();

// Insertar la nueva inscripción
$stmt = $conexion->prepare("INSERT INTO inscripciones (id_usuario, id_deporte, fecha_inscripcion, becado) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiii", $id_usuario, $id_deporte, $fecha_inscripcion, $becado);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al procesar la inscripción.']);
}

$stmt->close();
$conexion->close();
?>