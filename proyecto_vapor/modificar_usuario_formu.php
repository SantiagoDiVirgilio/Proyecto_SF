<?php
	include("conexion.php");
	$_SESSION['VARIABLE'] = session_id();

$id = $_GET['ID'];
$resultado_1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
$variable_1 = mysqli_fetch_array($resultado_1);
?>


<!doctype html>
<html>
<head>
    <link rel="icon" href="images/Vapor_Logo_Png.png" type="Images/png">
    <title>Modificar</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
</head>

<body>
	<img class="fondo" src="images/fondo_formu.jpg" alt="">
<header>
    <?php
    include("NAV.php");
    ?>
</header>
<article class="formu">
<section class="abm">
	<h3>MODIFICAR USUARIO
</h3>

	<form action="modificar_usuario.php" method="post" >
	<label>
		<input type="hidden" name="id" readonly="readonly" value="<?php echo $variable_1["id"]?>" /><br>
	</label><br>
	<label>Nombre:
		<input type="text" name="nombre" value="<?php echo $variable_1["nombre"]?>" /><br>
	</label><br />
	<label>Apellido:
		<input type="text" name="apellido" value="<?php echo $variable_1["apellido"]?>" /><br>
	</label><br />
	<label>Mail:
		<input type="email" name="mail" value="<?php echo $variable_1["mail"]?>" /><br>
	</label><br />
	<label>Usuario:
		<input type="text" name="usuario" value="<?php echo $variable_1["usuario"]?>" required /><br>
	</label><br />
	<label>Clave:
		<input type="password" name="clave" value="" required/><br>
	</label><br />
	<input class="boton" type="submit" value="MODIFICAR"/>	

</form>
</section>
<h5>¡ATENCIÓN! Se cerrará su sesión al modificar sus datos</h5>
</article>

<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

</body>
</html>