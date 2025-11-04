<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>

<?php
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$password = md5($_POST['password']);



	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "INSERT INTO usuarios (id, nombre, apellido, clave, mail, nivel, usuario) VALUES('', '$nombre','$apellido', '$password','$email', '0', '$usuario')");


	header("Location:iniciar_sesion.php");

?>	
    

</body>
</html>