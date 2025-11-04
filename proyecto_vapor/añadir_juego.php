<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AÑADIR JUEGO</title>
</head>

<body>
<?php 
	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();


?>



<?php
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$genero = $_POST['genero'];
	$desarrollador = $_POST['desarrollador'];
	$editor = $_POST['editor'];
	$lanzamiento = $_POST['lanzamiento'];
	$descripcion_chica = $_POST['descripcion_chica'];
	$descripcion_grande = $_POST['descripcion_grande'];
	$requisitos = $_POST['requisitos'];
	$ruta_imagenes = $_POST['ruta_imagenes'];




	$consulta = mysqli_query($conexion, "INSERT INTO juegos (ID, Nombre, Lanzamiento, codigo_genero, codigo_desarrollador, codigo_editor, Descripcion_Chica, Descripcion_Grande, Requisitos, Ruta_Imagenes) VALUES ('', '$nombre', '$lanzamiento', '$genero', '$desarrollador', '$editor', '$descripcion_chica', '$descripcion_grande', '$requisitos', '$ruta_imagenes')");

	header("Location:perfil.php");

?>	
    

</body>
</html>