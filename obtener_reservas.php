<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

$start = $_GET['start'] ?? date('Y-m-d');
$end = $_GET['end'] ?? date('Y-m-d', strtotime('+7 days'));
$cancha = $_GET['id_cancha'] ?? 1;

$sql = "SELECT id_reserva, id_usuario, fecha_reserva, hora_inicio, hora_fin,estado
        FROM reservas
        WHERE fecha_reserva BETWEEN ? AND ? AND id_cancha = ? AND estado != 'anulado'"; 
       
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $start, $end, $cancha);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);


$eventos = [];
while ($reserva = mysqli_fetch_assoc($resultado)) {
   
    $start_datetime = $reserva['fecha_reserva'] . 'T' . sprintf('%02d:00:00', $reserva['hora_inicio']);
    $end_datetime = $reserva['fecha_reserva'] . 'T' . sprintf('%02d:00:00', $reserva['hora_fin']);

    $eventos[] = [
        'id'    => $reserva['id_reserva'],
        'title' => ($reserva['estado'] == 'Confirmada') ? 'Confirmado' :'Reservado',
        'start' => $start_datetime,
        'end'   => $end_datetime,
        'estado'=> $reserva['estado'],
        'overlap' => false,
        'backgroundColor' => ($reserva['estado'] == 'Confirmada') ? '#f8d7da' : '#fff3cd',
        'borderColor' => ($reserva['estado'] == 'Confirmada') ? '#ff0019ff' : '#ffeeba',
        'textColor' => ($reserva['estado'] == 'Confirmada') ? '#721c24' : '#856404',
        'className' => 'evento-reservado',
    ];
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);

echo json_encode($eventos);
?>
