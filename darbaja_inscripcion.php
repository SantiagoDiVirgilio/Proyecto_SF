<?php 
session_start();
if (isset($_GET['id_deporte']) && isset ($_GET['id_usuario'])) {
    $id_deporte = (int)$_GET['id_deporte'];
	$id_usuario = (int)$_GET['id_usuario'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "DELETE FROM inscripciones WHERE id_deporte = '$id_deporte' AND id_usuario = '$id_usuario'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Inscripcion cancelada exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al cancelar la inscripcion: " . mysqli_error($conexion);
	    }
	} else {
	    $_SESSION['mensaje'] = "ID de deporte o usuario no especificado.";
	}	header("Location:perfil.php");
	exit();
?>