<?php 
session_start();
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cupo_maximo = $_POST['cupo_maximo'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "INSERT INTO deportes (nombre, descripcion, cupo_maximo) VALUES('$nombre','$descripcion','$cupo_maximo')");

	header("Location:deportes_tablas.php");
	exit();
?>