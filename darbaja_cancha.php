<?php 
session_start();
if (isset($_GET['id_cancha'])) {
    $id_cancha = (int)$_GET['id_cancha'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "DELETE FROM canchas WHERE id_cancha ='$id_cancha'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Cancha eliminada exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al eliminar la cancha: " . mysqli_error($conexion);
	    }
	} else {
	    $_SESSION['mensaje'] = "ID de cancha no especificado.";
	}	header("Location:canchas_tablas.php");
	exit();
?>