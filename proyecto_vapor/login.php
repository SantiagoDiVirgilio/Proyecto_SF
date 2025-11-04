<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
	<title>Login de Usuarios</title>
</head>

<body>

<?php
$usuario=$_POST['usuario'];
$clave=md5($_POST['clave']);

include("conexion.php");

$consulta=mysqli_query($conexion, "SELECT id, usuario, clave, nombre, apellido, nivel, mail FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");

$resultado=mysqli_num_rows($consulta);

if($resultado!=0){
	$respuesta=mysqli_fetch_array($consulta);
	include("perfil.php");
	$_SESSION['VARIABLE'] = session_id();
	$_SESSION['ID'] = $respuesta['id'];
	$_SESSION['USUARIO'] = $respuesta['usuario'];
	$_SESSION['CLAVE'] = $respuesta['clave'];
	$_SESSION['NOMBRE'] = $respuesta['nombre'];
	$_SESSION['APELLIDO'] = $respuesta['apellido'];
	$_SESSION['NIVEL'] = $respuesta['nivel'];
	$_SESSION['MAIL'] = $respuesta['mail'];

	header("Location:perfil.php");
}
else{
	echo '<h2 class="registro">NO ES UN USUARIO REGISTRADO </h2>';
	echo('<a class="registro" href="form_registro.php">¡REGISTRATE!</a>');
}?>

</body>
</html>