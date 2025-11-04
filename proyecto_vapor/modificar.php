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
	$genero = $_POST['genero'];
	$desarrollador = $_POST['desarrollador'];
	$editor = $_POST['editor'];
	$lanzamiento = $_POST['lanzamiento'];
	$descripcion_chica = $_POST['descripcion_chica'];
	$descripcion_grande = $_POST['descripcion_grande'];
	$requisitos = $_POST['requisitos'];
	$ruta_imagenes = $_POST['ruta_imagenes'];




	$consulta = mysqli_query($conexion, "UPDATE juegos
							 SET Nombre = '$nombre', codigo_genero = '$genero', codigo_desarrollador = '$desarrollador', codigo_editor = '$editor', Lanzamiento = '$lanzamiento', Descripcion_Chica = '$descripcion_chica',
							Descripcion_Grande = '$descripcion_grande', Requisitos = '$requisitos', Ruta_Imagenes = '$ruta_imagenes' 
							 WHERE ID = '$id'");

	header("Location:perfil.php");

?>	
    

</body>
</html>