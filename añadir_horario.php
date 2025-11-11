<?php 
session_start();
$id_cancha= $_POST['id_cancha'];
$horario = $_POST['horario'];
$disponible = $_POST['disponible'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	    $consulta = mysqli_query($conexion, "INSERT INTO horario_cancha (id_cancha, horario, disponible) VALUES id_cancha='$id_cancha', horario='$horario', disponible='$disponible'");
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Horario añadido exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al añadir el horario: " . mysqli_error($conexion);
	    }
	header("Location:horarios_tablas.php");
	exit();
?>