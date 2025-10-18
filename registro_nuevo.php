<!doctype html>
<html>
<head>
	<link rel="icon" href="imagenes/favicon.webp" type="image/webp">
	<title>Sistema de Gestion de Sociedad de Fomento</title>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
<header>
	<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	<?php
    	include("NAV.php");
    	include("conexion.php");
    ?>
    <div class="mobile-header-bar">
    <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
</header>

<?php
$nombre=$_POST['nombre'];
$clave=md5($_POST['clave']);

include("conexion.php");

$consulta=mysqli_query($conexion, "SELECT id_usuario, nombre, clave, dni, email, telefono, fecha_alta, rol FROM usuarios WHERE nombre='$nombre' AND clave='$clave'");

$resultado=mysqli_num_rows($consulta);

if($resultado!=0){
	$respuesta=mysqli_fetch_array($consulta);
	include("perfil.php");
	$_SESSION['VARIABLE'] = session_id();
	$_SESSION['ID'] = $respuesta['id_usuario'];
	$_SESSION['NOMBRE'] = $respuesta['nombre'];
	$_SESSION['CLAVE'] = $respuesta['clave'];
	$_SESSION['DNI'] = $respuesta['dni'];
	$_SESSION['EMAIL'] = $respuesta['email'];
	$_SESSION['TELEFONO'] = $respuesta['telefono'];
	$_SESSION['FECHA_ALTA'] = $respuesta['fecha_alta'];
	$_SESSION['ROL'] = $respuesta['rol'];

	header("Location:perfil.php");
}
else{
	echo '<h2 class="registro">NO ESTAS REGISTRADO O LOS DATOS SON INCORRECTOS</h2>';
	echo('<a class="registro" href="registro_nuevo.php">¡REGISTRATE!</a>');
}?>

</body>
</html>