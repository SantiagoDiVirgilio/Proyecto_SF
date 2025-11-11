<?php 
session_start();
$id_deporte = $_POST['id_deporte'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cupo_maximo = $_POST['cupo_maximo'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "UPDATE deportes 
     SET nombre='$nombre', descripcion='$descripcion', cupo_maximo='$cupo_maximo'
     WHERE id_deporte='$id_deporte'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Deporte modificado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al modificar el deporte: " . mysqli_error($conexion);
	    }
	header("Location:deportes_tablas.php");
	exit();
?>