
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
$telefono = $_POST['telefono'];
$comentario = $_POST['comentario'];
$fecha_envio = date('Y-m-d');
$estado = $_POST['estado'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje, fecha_envio, estado) VALUES('$nombre','$email','$telefono','$comentario', 'l jS \of F Y h:i:s A','Sin Resolver')");

	header("Location:iniciar_sesion.php");
?>  

</body>
</html>