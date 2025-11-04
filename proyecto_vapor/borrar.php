<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>EDITAR</title>
</head>

<body>
<?php 
	include("conexion.php");

	$_SESSION['VARIABLE'] = session_id();
?>

<?php
	echo'<script type="text/javascript">
    alert("Usted está por eliminar un juego de la Base de Datos<br>¿Está seguro de seguir adelante?");
    window.location.href="borrar.php";
    </script>';
	$id = $_GET['ID'];

	$consulta = mysqli_query($conexion, "DELETE FROM juegos WHERE ID = '$id'");

	header("Location:perfil.php");

?>	
<!-- Funcion de alerta de borrado de juegos -->
<?php
function function_alert($message) {
    echo "<script>alert('$message');</script>";
}    
?>	
</body>
</html>