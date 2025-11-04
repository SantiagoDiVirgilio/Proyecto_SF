<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AÑADIR GENERO</title>
</head>

<body>
<?php 
	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();


?>



<?php
	$id = $_POST['id'];
	$genero = $_POST['genero'];




	$consulta = mysqli_query($conexion, "INSERT INTO generos (id, genero) VALUES ('', '$genero')");

	header("Location:perfil.php");

?>	
    

</body>
</html>