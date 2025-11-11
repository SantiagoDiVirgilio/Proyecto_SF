<?php 
session_start();
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "UPDATE usuarios 
     SET rol='$rol' WHERE id_usuario='$id_usuario'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Usuario modificado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al modificar el usuario: " . mysqli_error($conexion);
	    }
	header("Location:usuarios_tablas.php");
	exit();
?>