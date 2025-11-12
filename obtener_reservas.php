<?php
session_start();
header('Content-Type: application/json');
include("conexion.php");

/*
if (!isset($_GET['start']) || !isset($_GET['end'])) {
    die(json_encode([]));
}
    */
// Usamos las fechas que envía FullCalendar para que sea dinámico.
$start = $_GET['start'] ?? date('Y-m-d');
$end = $_GET['end'] ?? date('Y-m-d', strtotime('+7 days'));
$cancha = $_GET['id_cancha'] ?? 1;

// AND estado = 'confirmado'";
// Corregí la lógica de la consulta para usar un rango de fechas (entre start y end).
// También selecciono los campos necesarios para el evento de FullCalendar.
$sql = "SELECT id_reserva, id_usuario, fecha_reserva, hora_inicio, hora_fin,estado
        FROM reservas 
        WHERE fecha_reserva BETWEEN ? AND ? AND id_cancha = ?"; 
       
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $start, $end, $cancha);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

/*-------------------- ver lo que trae la consulta
while ($fila = mysqli_fetch_assoc($resultado)) {
            
        echo "ID: " . $fila['id_reserva'] . 
             ", Fecha: " . $fila['fecha_reserva'] . 
             ", Hora: " . $fila['hora_inicio'] . "<br>";
    }
var_dump(mysqli_fetch_all($resultado, MYSQLI_ASSOC));
exit;
*/

$eventos = [];
while ($reserva = mysqli_fetch_assoc($resultado)) {
    // Combinamos fecha y hora para el formato que necesita FullCalendar (ISO 8601)
 
    $start_datetime = $reserva['fecha_reserva'] . 'T' . sprintf('%02d:00:00', $reserva['hora_inicio']);
    $end_datetime = $reserva['fecha_reserva'] . 'T' . sprintf('%02d:00:00', $reserva['hora_fin']);

    $eventos[] = [
        'id'    => $reserva['id_reserva'],
        'title' => ($reserva['estado'] == 'Confirmada') ? 'Confirmado' :'Reservado',
        'start' => $start_datetime,
        'end'   => $end_datetime,
        'estado'=> $reserva['estado'],
        'overlap' => false,
        'backgroundColor' => ($reserva['estado'] == 'Confirmada') ? '#f8d7da' : '#fff3cd', // Rojo si está pagado, amarillo si no.
        'borderColor' => ($reserva['estado'] == 'Confirmada') ? '#ff0019ff' : '#ffeeba',
        'textColor' => ($reserva['estado'] == 'Confirmada') ? '#721c24' : '#856404',
        'className' => 'evento-reservado', // Clase CSS para estilizar el evento
    ];
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);

echo json_encode($eventos);
?>
