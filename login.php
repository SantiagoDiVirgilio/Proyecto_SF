<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<title>Login de Usuarios</title>
</head>

<body>
<header>
	<?php
    include("NAV.php");
    ?>
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
	echo('<a class="registro" href="form_registro.php">¡REGISTRATE!</a>');
}?>

</body>
</html>