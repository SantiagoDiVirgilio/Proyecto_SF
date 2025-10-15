<!DOCTYPE html>
<html lang="es">

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
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	
	<?php
    include("NAV.php");
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
<?php
   include("conexion.php");
   $resultado_2 = mysqli_query($conexion, "SELECT * FROM deportes");
 ?>
<!-- Llamamos a la base de datos para que cargue tanto, el tipo de deporte como las canchas de dicho 
 deporte-->
<?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
        <section class="titulo_deportes"id="<?php echo $variable_2["nombre"]; ?>">
            <h2 id="<?php $variable_2["nombre"]; ?>"><?php echo $variable_2["nombre"]; ?></h2> 

            <div class="canchas-container">
            <?php $resultado_1 = mysqli_query($conexion, "SELECT * FROM canchas"); ?>
            <?php while($variable_1 = mysqli_fetch_assoc($resultado_1)){?>
            
                <?php if($variable_1["tipo"] == $variable_2["nombre"]){?>
                    <div class="cancha-card">
                        <img src="imagenes/futbol.png" alt="Portada de cancha Futbol 5">
                        <div class="cancha-card-body">
                            <h4><?php echo $variable_1["nombre"]; ?></h4>
                            <p><?php echo $variable_1["descripcion"]; ?></p>
                            <p class="precio"><?php echo $variable_1["precio_hora"]; ?></p>
                            <a href="inscripcion_1.php" class="btn-alquilar">Ver Horarios</a>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            </div>
        </section>
    <?php }?>
<?php ?>   

<footer>
<?php
    include("FOOTER.php");
?>
</footer>

<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.redes').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});

function toggleMenu() {
  var x = document.getElementById("myTopnav");
  if (x.className.includes("responsive")) {
    x.className = "";
  } else {
    x.className += " responsive";
  }
}
</script>
</body>

</html>