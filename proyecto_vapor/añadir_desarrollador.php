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
	$desarrollador = $_POST['desarrollador'];




	$consulta = mysqli_query($conexion, "INSERT INTO desarrollador (ID, desarrollador) VALUES ('', '$desarrollador')");

	header("Location:perfil.php");

?>	
    

</body>
</html>