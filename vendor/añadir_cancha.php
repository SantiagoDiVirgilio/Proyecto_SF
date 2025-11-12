<?php 
session_start();
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "INSERT INTO canchas (nombre, tipo, descripcion, precio_hora) VALUES('$nombre','$tipo', '$descripcion','$precio')");

	header("Location:canchas_tablas.php");
	exit();
?>