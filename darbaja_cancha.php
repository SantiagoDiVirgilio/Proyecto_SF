<?php 
session_start();
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	$consulta = mysqli_query($conexion, "DELETE FROM canchas WHERE nombre ='$nombre' AND tipo='$tipo'");

	header("Location:administracion.php");
	exit();
?>