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
//$clave=md5($_POST['clave']);

// Debugging code
//echo "Email: " . $email . "<br>";
//echo "Clave (MD5): " . $clave . "<br>";
//echo "Error de la base de datos: " . mysqli_error($conexion) . "<br>";

include("conexion.php");


	echo '<h2 class="registro">¡TE HCIISTE SOCIO!</h2>';
	echo('<a class="registro" href="index.php">VOLVER A INICIO</a>');
?>

</body>
</html>