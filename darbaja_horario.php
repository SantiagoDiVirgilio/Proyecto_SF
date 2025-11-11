<?php 
session_start();
if (isset($_GET['id_horario'])) {
    $id_horario = (int)$_GET['id_horario'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "DELETE FROM horario_cancha WHERE id_horario ='$id_horario'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Horario eliminado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al eliminar el horario: " . mysqli_error($conexion);
	    }
	} else {
	    $_SESSION['mensaje'] = "ID de horario no especificado.";
	}	header("Location:horarios_tablas.php");
	exit();
?>