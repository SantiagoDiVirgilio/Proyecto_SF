<?php session_start(); ?>
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
$email = $_POST['email'];
$password_ingresada = $_POST['clave'];


$sql = "SELECT id_usuario, nombre, clave, dni, email, telefono, fecha_alta, rol FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);


if ($usuario = mysqli_fetch_assoc($resultado)) {
    
    if (password_verify($password_ingresada, $usuario['clave'])) {
     
        $_SESSION['VARIABLE'] = session_id();
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['NOMBRE'] = $usuario['nombre'];
        $_SESSION['DNI'] = $usuario['dni'];
        $_SESSION['EMAIL'] = $usuario['email'];
        $_SESSION['TELEFONO'] = $usuario['telefono'];
        $_SESSION['FECHA_ALTA'] = $usuario['fecha_alta'];
        $_SESSION['ROL'] = $usuario['rol'];

        header("Location: deportes.php");
        exit(); 
	    }
}


echo '<h2 class="registro">El email o la contraseña son incorrectos.</h2>';
echo('<a class="registro" href="registro_nuevo.php">¿No tienes cuenta? ¡REGÍSTRATE!</a>');

mysqli_stmt_close($stmt);
?>

</body>
</html>