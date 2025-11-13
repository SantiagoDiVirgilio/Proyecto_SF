<?php 
session_start();
$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$rol = $_POST['rol'];

	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();

	 // Comprueba si se ha seleccionado un nuevo rol
	 if (!empty($rol)) {
		// Si se selecciona un nuevo rol, actualízalo junto con los demás campos
		$consulta = mysqli_query($conexion, "UPDATE usuarios 
		SET nombre='$nombre', dni='$dni', email='$email', telefono='$telefono', rol='$rol' WHERE id_usuario='$id_usuario'");
	} else {
		// Si no se selecciona un nuevo rol, conserva el rol original
		$consulta = mysqli_query($conexion, "UPDATE usuarios 
		SET nombre='$nombre', dni='$dni', email='$email', telefono='$telefono' WHERE id_usuario='$id_usuario'");
	}
	
	    if ($consulta) {
	        $_SESSION['mensaje'] = "Usuario modificado exitosamente.";
	    } else {
	        $_SESSION['mensaje'] = "Error al modificar el usuario: " . mysqli_error($conexion);
	    }
	if (isset($_SESSION['ROL']) && (strtolower($_SESSION['ROL']) == 'admin')) {
             header("Location:usuarios_tablas.php");
        } else {
            header("Location:perfil.php");
        }
	exit();
?>