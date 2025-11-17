<?php session_start(); ?>
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

<body class="home-background">
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
		
	<?php
    include("NAV.php");
    ?>
	<div class="mobile-header-bar">
    <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</div>

	</header>

	<div class="hero-section">
		<article>
			<h3>¿Qué es S.G.S.F?</h3>
				<p><strong>Sistema de Gestión de Sociedad de Fomento</strong> (o por sus siglas S.G.S.F) es un sistema web de gestión de reservas de canchas y salones 
				del club Sociedad De Fomento. Fue diseñado con los lenguajes HTML5, PHP, JavaScript y MySQL.
				<br>En este sistema se puede reservar distintas canchas y el salón de fiestas, así como inscribirse mensualmente
				a los deportes presentados. 
				<br>Si bien para reservar no es necesario ser un usuario registrado, SÍ debe serlo para inscribirse
				a los deportes. Para consultas particulares, diríjase al formulario de "Contacto".
				</p>
		</article>
	</div>

	<section class="team-section">
		<div class="titulo_deportes">
			<h2><span>Nuestro Equipo</span></h2>
		</div>
		<div class="team-container">
			
			<div class="team-card">
				<img src="imagenes/Mateo.webp" alt="Foto de Mateo Alvarez San Juan">
				<div class="team-card-body">
					<h4>Mateo Alvarez San Juan</h4>
					<p class="team-role">Desarrollador</p>
					<p class="team-description">Especialista en la interfaz de usuario y la experiencia de usuario (UI/UX), creando un diseño intuitivo y atractivo para los visitantes.</p>
				</div>
			</div>
			
			<div class="team-card">
				<img src="imagenes/Martin.webp" alt="Foto de Martin Rodolfo Castaño">
				<div class="team-card-body">
					<h4>Martin Rodolfo Castaño</h4>
					<p class="team-role">Desarrollador</p>
					<p class="team-description">Encargado de la integración de APIs y servicios externos, como la pasarela de pagos, y de la seguridad general del sitio web.</p>
				</div>
			</div>
			
			<div class="team-card">
				<img src="imagenes/Agustin.webp" alt="Foto de Agustin Dotto">
				<div class="team-card-body">
					<h4>Agustin Dotto</h4>
					<p class="team-role">Desarrollador</p>
					<p class="team-description">Encargado de la documentación técnica del proyecto. Colaboración en la implementación de funcionalidades clave para la comunicación del sitio web.</p>
				</div>
			</div>
			
			<div class="team-card">
				<img src="imagenes/Santiago.webp" alt="Foto de Santiago Ezequiel Di Virgilio">
				<div class="team-card-body">
					<h4>Santiago Ezequiel Di Virgilio</h4>
					<p class="team-role">Líder de Proyecto</p>
					<p class="team-description">Coordina el equipo de desarrollo, define las metas del proyecto y se asegura de que el producto final cumpla con los objetivos establecidos.</p>
				</div>
			</div>
		</div>
	</section>

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