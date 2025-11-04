<?php
	include("conexion.php");
	$_SESSION['VARIABLE'] = session_id();

$id = $_GET['ID'];
$resultado_1 = mysqli_query($conexion, "SELECT * FROM juegos WHERE ID = '$id'");
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
<?php 

$resultado_2 = mysqli_query($conexion, "SELECT * FROM generos");

$resultado_3 = mysqli_query($conexion, "SELECT * FROM desarrollador");

$resultado_4 = mysqli_query($conexion, "SELECT * FROM editor");
?>

<article class="formu">
<section class="abm">
	<h3>MODIFICAR
</h3>
	<br>
	<form action="modificar.php" method="post" >
	<label>ID:
		<input type="text" name="id" readonly="readonly" value="<?php echo $variable_1["ID"]?>" /><br>
	</label><br />
	<label>Nombre:
		<input type="text" name="nombre" value="<?php echo $variable_1["Nombre"]?>" /><br>
	</label><br />

	<label>Genero:
	<select name="genero">
	<?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
	<?php if($variable_1["codigo_genero"] == $variable_2["id"]){?>
  	<option selected = 'selected' value="<?php echo $variable_2["id"]?>"><?php echo $variable_2["genero"]?></option>
	  <?php }else {?>
		<option value="<?php echo $variable_2["id"]?>"><?php echo $variable_2["genero"]?></option>
	  <?php } ?>
	  <?php }?>
	</select>
	</label><br />
	<br>
	<label>Desarrollador:
	<select name="desarrollador">
	<?php while($variable_3 = mysqli_fetch_assoc($resultado_3)){?>
	<?php if($variable_1["codigo_desarrollador"] == $variable_3["ID"]){?>
  	<option selected = 'selected' value="<?php echo $variable_3["ID"]?>"><?php echo $variable_3["Desarrollador"]?></option>
	  <?php }else {?>
		<option value="<?php echo $variable_3["ID"]?>"><?php echo $variable_3["Desarrollador"]?></option>
	  <?php } ?>
	  <?php }?>
	</select>
	</label><br />
	<br>

	<label>Editor:
	<select name="editor">
	<?php while($variable_4 = mysqli_fetch_assoc($resultado_4)){?>
	<?php if($variable_1["codigo_editor"] == $variable_4["ID"]){?>
  	<option selected = 'selected' value="<?php echo $variable_4["ID"]?>"><?php echo $variable_4["Editor"]?></option>
	  <?php }else {?>
		<option value="<?php echo $variable_4["ID"]?>"><?php echo $variable_4["Editor"]?></option>
	  <?php } ?>
	  <?php }?>
	</select>
	</label><br />
	<br>
	<label>Lanzamiento:
		<input type="date" name="lanzamiento" value="<?php echo $variable_1["Lanzamiento"]?>" /><br>
	</label><br />
	<label>Descripcion_Chica:
		<input type="text" name="descripcion_chica" value="<?php echo $variable_1["Descripcion_Chica"]?>"/><br>
	</label><br />
	<label>Descripcion_Grande:
		<input type="text" name="descripcion_grande" type="text" value="<?php echo $variable_1["Descripcion_Grande"]?>"/><br>
	</label><br />
	<label>Requisitos:
		<input type="text" name="requisitos"value="<?php echo $variable_1["Requisitos"]?>" /><br>
	</label><br />
	<label>Ruta_Imagenes:
		<input type="text" name="ruta_imagenes" value='<?php echo $variable_1["Ruta_Imagenes"]?>' /><br>
	</label><br />
	<input class="boton" type="submit" value="MODIFICAR"/>	

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