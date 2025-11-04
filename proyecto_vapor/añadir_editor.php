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
	$editor = $_POST['editor'];




	$consulta = mysqli_query($conexion, "INSERT INTO editor (ID, Editor) VALUES ('', '$editor')");

	header("Location:perfil.php");

?>	
    

</body>
</html>