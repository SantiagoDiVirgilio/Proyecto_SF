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
//Hola Mateo
	if (isset($_GET['buscar_usuario']) && !empty($_GET['buscar_usuario'])) {
		$buscar = $_GET['buscar_usuario'];
		echo "Resultados de búsqueda para: <em>".htmlspecialchars($buscar)."</em><br>";
?>
</h3>
</article>
<article class="busqueda">
<?php
		$buscar_seguro = mysqli_real_escape_string($conexion, $buscar);
		$resultado_1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar_seguro%' ");

		if ($resultado_1 && mysqli_num_rows($resultado_1) > 0) {
			$nros = mysqli_num_rows($resultado_1);
?>
		<p>
		<h2>Cantidad de Resultados: <?php echo $nros; ?></h2> 
		</p>
	    <section class="canchas-container">
<?php
			while($variable_1 = mysqli_fetch_array($resultado_1)) {
?>
	    <div class="cancha-card">
                <div class="cancha-card-body">
                    <h4>
                        <a href="perfil.php?id=<?php echo $variable_1["id_usuario"];?>">
                            <?php echo htmlspecialchars($variable_1["nombre"]); ?>
							<?php echo htmlspecialchars($variable_1["dni"]); ?>
                        </a>
                    </h4>
                    <p>Ver perfil de usuario.</p>
                </div>
            </div>
<?php
			} // fin while de BUSQUEDA DE USUARIOS
?>
		</section>
<?php
            mysqli_free_result($resultado_1);
        } else {
            echo "<p>No se encontraron resultados para usuarios.</p>";
        }
		mysqli_close($conexion);
	} elseif (isset($_GET['buscar_deporte']) && !empty($_GET['buscar_deporte'])) {
		$buscar = $_GET['buscar_deporte'];
		echo "Resultados de búsqueda para: <em>".htmlspecialchars($buscar)."</em><br>";
?>
</h3>
</article>
<article class="busqueda">
<?php
		$buscar_seguro = mysqli_real_escape_string($conexion, $buscar);
		$resultado_2 = mysqli_query($conexion, "SELECT * FROM deportes WHERE nombre LIKE '%$buscar_seguro%' ");

		if ($resultado_2 && mysqli_num_rows($resultado_2) > 0) {
			$nros = mysqli_num_rows($resultado_2);
?>
		<p>
		<h2>Cantidad de Resultados: <?php echo $nros; ?></h2> 
		</p>
	    <section class="canchas-container">
<?php
			while($variable_2 = mysqli_fetch_array($resultado_2)) {
?>
	    <div class="cancha-card">
                <a href="deportes.php?ID=<?php echo $variable_2["id_deporte"];?>">
                    <img src="imagenes/<?php echo htmlspecialchars(strtoupper($variable_2["nombre"])).'.png'; ?>" alt="<?php echo htmlspecialchars($variable_2["nombre"]); ?>">
                </a>
                <div class="cancha-card-body">
                    <h4>
                        <a href="deportes.php?ID=<?php echo $variable_2["id_deporte"];?>">
                            <?php echo htmlspecialchars($variable_2["nombre"]); ?>
                        </a>
                    </h4>
                    <p>Más detalles sobre <?php echo htmlspecialchars(strtolower($variable_2["nombre"])); ?>.</p>
                </div>
            </div>
<?php
			} // fin while DE BUSQUEDA DE DEPORTES
?>
		</section>
<?php
            mysqli_free_result($resultado_2);
        } else {
            echo "<p>No se encontraron resultados para deportes.</p>";
        }
		mysqli_close($conexion);
	} else {
?>
</h3>
</article>
<article class="busqueda">
<?php
		echo "<p>Por favor, ingrese un término de búsqueda.</p>";
        if (isset($conexion)) {
            mysqli_close($conexion);
        }
	}
?>
</article>
</section>
<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

</body>
</html>