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
	include('NAV.php');
?>
</header>
<section>

<article class="busqueda">
<h3>
<?php
	include('conexion.php');

	$buscar = $_GET['buscar'];
	echo "Resultados de búsqueda para: <em>".$buscar."</em><br>";

	$resultado_1 = mysqli_query($conexion, "SELECT * FROM juegos WHERE Nombre LIKE '%$buscar%' ");
?>
</h3>
</article>
<article class="busqueda">
		<p>
		<h2>Cantidad de Resultados:
		<?php
			$nros=mysqli_num_rows($resultado_1);
			echo $nros;
		?>
		</h2> 
		</p>
	    <section class="generos" >

		
		<?php
			while($variable_1=mysqli_fetch_array($resultado_1)) {?>

	    <div style="margin-bottom: 3%;">
	    	
			<a href="juego_dinamico.php?ID=<?php echo $variable_1["ID"];?>"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_Portada.jpg'; ?>"  class="zoom">
			<br><?php echo $variable_1["Nombre"]; ?></a>

			<?php $id_g = $variable_1["codigo_genero"]?>
			<?php $resultado_2 = mysqli_query($conexion, "SELECT * FROM generos WHERE id='$id_g'");?>
			<?php $variable_2 = mysqli_fetch_array($resultado_2)?>
			
			<p>GENERO: <?php echo $variable_2["genero"]; ?></p>
			<p>FECHA DE LANZAMIENTO: <?php echo $variable_1["Lanzamiento"]; ?></p>
		
			</div>

	    <?php
			}

			mysqli_free_result($consulta);
			mysqli_close($conexion);
		?>
		</section>
</article>
</section>
<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

</body>
</html>