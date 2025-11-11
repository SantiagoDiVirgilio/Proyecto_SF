<?php 
session_start();
$id_usuario = $_GET['id_usuario'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "DELETE FROM usuarios WHERE id_usuario ='$id_usuario'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Usuario eliminado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al eliminar al usuario: " . mysqli_error($conexion);
	    }
		
		header("Location:usuarios_tablas.php");
	exit();
?>