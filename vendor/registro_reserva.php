<?php
// Iniciar la sesión para poder acceder a las variables de sesión
session_start();

include("conexion.php");

// 1. Validar y recoger los datos del formulario
if (isset($_POST['id_horario'], $_POST['nombre'], $_POST['telefono'], $_POST['fecha_pago'])) {
    $id_horario = $_POST['id_horario'];
    $nombre_cliente = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha_pago_str = $_POST['fecha_pago'];

    // Convertir la fecha de pago a un formato DATETIME para MySQL
    $fecha_pago = date('Y-m-d H:i:s', strtotime($fecha_pago_str));

} else {
    die("Error: Faltan datos del formulario.");
}

// 2. Obtener información adicional a partir del id_horario
$stmt_horario = mysqli_prepare($conexion, "SELECT id_cancha, horario FROM horario_cancha WHERE id_horario = ?");
mysqli_stmt_bind_param($stmt_horario, "i", $id_horario);
mysqli_stmt_execute($stmt_horario);
$resultado_horario = mysqli_stmt_get_result($stmt_horario);

if ($fila_horario = mysqli_fetch_assoc($resultado_horario)) {
    $id_cancha = $fila_horario['id_cancha'];
    $hora_usuario = $fila_horario['horario'];
} else {
    die("Error: Horario no válido.");
}
mysqli_stmt_close($stmt_horario);

// 3. Preparar los datos restantes para la inserción
$id_usuario = $_SESSION['id_usuario'] ?? 0; // Usar 0 si el usuario no está logueado
$fecha_reserva = date('Y-m-d'); // La fecha en que se hace el registro
$hora_fin = $hora_usuario; // Asumimos que la reserva es de 1 hora, puedes ajustar esto
$monto_senia = 0.00; // Valor por defecto, ya que no viene del formulario
$estado = 'Pagado'; // Estado por defecto

// 4. Insertar la reserva en la base de datos usando sentencias preparadas
$sql = "INSERT INTO reservas (id_cancha, id_usuario, nombre_cliente, telefono, fecha_reserva, hora_reserva, monto_senia estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_insert = mysqli_prepare($conexion, $sql);

if ($stmt_insert === false) {
    die("Error al preparar la consulta: " . mysqli_error($conexion));
}

// Vincular parámetros: i = integer, s = string, d = double
mysqli_stmt_bind_param($stmt_insert, "iisssssdss", 
    $id_cancha,
    $id_usuario,
    $nombre_cliente,
    $telefono,
    $fecha_reserva,
    $hora_usuario,
    $hora_fin,
    $monto_senia,
    $fecha_pago,
    $estado
);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt_insert)) {
    // Redirigir a una página de éxito o a donde prefieras
    header("Location: alquileres.php?reserva=exitosa");
} else {
    echo "Error al registrar la reserva: " . mysqli_stmt_error($stmt_insert);
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt_insert);
mysqli_close($conexion);

?>
