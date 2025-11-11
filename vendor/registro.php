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
$password = $_POST['password'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$fecha_alta = date('Y-m-d');

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "INSERT INTO usuarios (nombre, clave, dni, email, telefono, fecha_alta, rol, id_sesion) VALUES('$nombre','$password','$dni', '$email','$telefono','$fecha_alta', 'usuario', '')");

	header("Location:iniciar_sesion.php");
?>  

</body>
</html>