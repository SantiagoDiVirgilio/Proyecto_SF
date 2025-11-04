<?php
	include("conexion.php");
	$_SESSION['VARIABLE'] = session_id();

?>


<!doctype html>
<html>
<head>
    <link rel="icon" href="images/Vapor_Logo_Png.png" type="Images/png">
    <title>Vapor: The Proyect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
</head>

<body>
<header>
    <?php
    include("NAV.php");
    ?>
</header>
<img class="fondo" src="images/fondo_formu.jpg" alt="">
<?php 

$resultado_2 = mysqli_query($conexion, "SELECT * FROM generos");

$resultado_3 = mysqli_query($conexion, "SELECT * FROM desarrollador");

$resultado_4 = mysqli_query($conexion, "SELECT * FROM editor");
?>

<article class="formu">
<section class="abm">
	<h3>AÑADIR
</h3>
<br>
	<form action="añadir_juego.php" method="post" >
	<label>ID:
		<input type="number" name="id" readonly="readonly" /><br>
	</label><br />
	<label>Nombre:
		<input type="text" name="nombre" /><br>
	</label><br />
	<label>Lanzamiento:
		<input type="date" name="lanzamiento" /><br>
	</label><br />


	<label>Genero:
	<select name="genero">
	<?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
		<option value="<?php echo $variable_2["id"]?>"><?php echo $variable_2["genero"]?></option>
	  <?php } ?>
	</select>
	</label><br />
	<br>

	<label>Desarrollador:
	<select name="desarrollador">
	<?php while($variable_3 = mysqli_fetch_assoc($resultado_3)){?>
		<option value="<?php echo $variable_3["ID"]?>"><?php echo $variable_3["Desarrollador"]?></option>
	  <?php }?>
	</select>
	</label><br />
	<br>

	<label>Editor:
	<select name="editor">
	<?php while($variable_4 = mysqli_fetch_assoc($resultado_4)){?>
		<option value="<?php echo $variable_4["ID"]?>"><?php echo $variable_4["Editor"]?></option>
	  <?php } ?>
	</select>
	</label><br />

	<br>
	<label>Descripcion_Chica:
		<input type="text" name="descripcion_chica"/><br>
	</label><br />
	<label>Descripcion_Grande:
		<input type="text" name="descripcion_grande" type="text" /><br>
	</label><br />
	<label>Requisitos:
		<input type="text" name="requisitos" /><br>
	</label><br />
	<label>Ruta_Imagenes:
		<input type="text" name="ruta_imagenes" /><br>
	</label><br />
	<input type="submit" value="AÑADIR"/>	<br>



</form>
</section>
</article>

<footer>
<?php
    include("FOOTER.php");
    ?>
</footer> 

</body>
</html>