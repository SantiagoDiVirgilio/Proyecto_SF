<?php 
session_start();
$id_horario = $_POST['id_horario'];
$id_cancha= $_POST['id_cancha'];
$horario = $_POST['horario'];
$disponible = $_POST['disponible'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "UPDATE horario_cancha 
     SET id_cancha='$id_cancha', horario='$horario', disponible='$disponible'
     WHERE id_horario='$id_horario'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Horario modificado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al modificar el horario: " . mysqli_error($conexion);
	    }
	header("Location:horarios_tablas.php");
	exit();
?>