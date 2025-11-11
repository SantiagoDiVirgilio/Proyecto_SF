<?php 
session_start();
if (isset($_GET['id_deporte'])) {
    $id_deporte = (int)$_GET['id_deporte'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "DELETE FROM deportes WHERE id_deporte ='$id_deporte'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Deporte eliminado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al eliminar el deporte: " . mysqli_error($conexion);
	    }
	} else {
	    $_SESSION['mensaje'] = "ID de deporte no especificado.";
	}	header("Location:deportes_tablas.php");
	exit();
?>