<!doctype html>
<html>
<head>
	<link rel="icon" href="imagenes/favicon.webp" type="image/webp">
	<title>Sistema de Gestion de Sociedad de Fomento</title>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
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

	if($_GET['name'] == 'buscar_usuario'){
	$buscar = $_GET['buscar_usuario'];
	echo "Resultados de búsqueda para: <em>".$buscar."</em><br>";

	$resultado_1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar%' ");
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
	    <section class="canchas-container">
		<?php
			while($variable_1=mysqli_fetch_array($resultado_1)) {?>

	    <div class="deporte-card">
			<a href="deportes.php?ID=<?php echo $variable_1["id_usuario"];?>">
			<br><?php echo $variable_1["nombre"]; ?></a>		
			</div>
	    <?php
			}
		}
		else{
			print("Jaja bobo");
		}
			mysqli_free_result($resultado_1);
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