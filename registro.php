<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>

<?php 
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password_plain = $_POST['clave'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$fecha_alta = date('Y-m-d');

$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

include("conexion.php");

// Usar sentencias preparadas para prevenir inyección SQL
$sql = "INSERT INTO usuarios (nombre, clave, dni, email, telefono, fecha_alta, rol) VALUES(?, ?, ?, ?, ?, ?, 'usuario')";
$stmt = mysqli_prepare($conexion, $sql);

// "ssssss" indica que los 6 parámetros son strings (cadenas de texto)
mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $hashed_password, $dni, $email, $telefono, $fecha_alta);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header("Location:iniciar_sesion.php?registro=exitoso");
?>  

</body>
</html>