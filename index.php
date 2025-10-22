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

	<div class="container-principal">
		<div class="columna-texto">
			<article >
				<h3>Sobre Nosotros:</h3>
					<p>Somos un equipo de trabajo dedicado y unido, estudiantes de la TUP en la Universidad Tecnológica Nacional, regional de Haedo,
					<br>cuyos participantes somos:
					<br>
					<ul>
						<li><i>Mateo Álvarez San Juan</i></li>
						<li><i>Martín Castaño</i></li>
						<li><i>Agustín Dotto</i></li>
						<li><i>Santiago Di Virgilio</i></li>
					</ul>
					</p>
			</article>
	
			<article>
				<h3>¿Que es S.G.S.F?</h3>
					<p><strong>Sistema de Gestión de Sociedad de Fomento</strong> (O por sus siglas S.G.S.F) es un sistema web de gestion de reservas de canchas y salones 
					<br>del club Sociedad De Fomento. Fue diseñado con los lenguajes HTML5, PHP, JavaScript y MySQL.
					<br>En este sistema se puede reservar distintas canchas (de diversos deportes realizados en el Club) y del salon de fiestas, asi como inscribirse mensulamente
					a los deportes presentados. 
					<br>Si bien, para reservar las canchas no es necesario ser un usuario registrado, SI debe serlo para inscribirse
					mensualmente a los deportes presentados. Para cosnultas particulares drigrise al formulario de "Contacto" de nuestro sitio web.
					</p>
			</article>
	
			<article>
				<h3><em></em></h3>
					<p>
					</p> 
			</article>
		</div>
		<div class="columna-imagen">
			<img src="imagenes/fondo_inicio.webp" alt="Imagen del club">
		</div>
	</div>

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