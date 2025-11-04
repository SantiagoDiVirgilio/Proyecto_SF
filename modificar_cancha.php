<?php 
session_start();
$id_cancha = $_POST['id_cancha'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "UPDATE canchas 
     SET nombre='$nombre', tipo='$tipo', descripcion='$descripcion', precio_hora='$precio'
     WHERE id_cancha='$id_cancha'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Cancha modificada exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al modificar la cancha: " . mysqli_error($conexion);
	    }
	header("Location:canchas_tablas.php");
	exit();
?>