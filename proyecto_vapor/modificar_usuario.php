<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>EDITAR</title>
</head>

<body>
<?php 
	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();


?>



<?php
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$mail = $_POST['mail'];
	$usuario = $_POST['usuario'];
	$clave = md5($_POST['clave']);




	$consulta = mysqli_query($conexion, "UPDATE usuarios
							 SET nombre = '$nombre', apellido = '$apellido', mail = '$mail', usuario = '$usuario', clave = '$clave'
							 WHERE id = '$id'");

	include("cerrar_sesion.php");
?>	
    

</body>
</html>