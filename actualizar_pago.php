<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

$id_pago = $_POST['id_pago'] ?? null;
$estado = $_POST['estado'] ?? null;

if (!$id_pago || !$estado) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para actualizar el pago (id_pago, estado).']);
    exit;
}

$sql = "UPDATE pagos SET estado = ? WHERE id_pago = ?";

$stmt_update = mysqli_prepare($conexion, $sql);

if ($stmt_update === false) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . mysqli_error($conexion)]);
    exit;
}


mysqli_stmt_bind_param($stmt_update, "si", $estado, $id_pago);


if (mysqli_stmt_execute($stmt_update)) {
    echo json_encode(['success' => true, 'message' => 'Pago actualizado correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el pago: ' . mysqli_stmt_error($stmt_update)]);
}
mysqli_stmt_close($stmt_update);
mysqli_close($conexion);
?>
