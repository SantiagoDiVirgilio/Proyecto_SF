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
					<p>Somos un equipo de trabajo dedicado y unido, estudiantes de la TUP en la UTN regional de Haedo
					</p>
			</article>
	
			<article>
				<h3>¿Que es S.G.S.F?</h3>
					<p><strong>Sistema de Gestión de Sociedad de Fomento</strong> (O por sus siglas S.G.S.F)
					</p>
			</article>
	
			<article>
				<h3><em></em></h3>
					<p>
					</p> 
			</article>
		</div>
	</div>

	<footer>
		<div>
		<div class="redes-sociales">
			<a href="https://es-la.facebook.com/" target="_blank"><img src="imagenes/icono_facebook.webp" alt="Facebook" class="redes"></a>
			<a href="https://www.instagram.com/" target="_blank"><img src="imagenes/icono_instagram.webp" alt="Instagram" class="redes"> </a>
			<a href="https://twitter.com/i/flow/login?input_flow_data=%7B%22requested_variant%22%3A%22eyJsYW5nIjoiZXMifQ%3D%3D%22%7D" target="_blank"><img src="imagenes/icono_twitter.webp" alt="Twitter" class="redes"></a>
			<a href="https://www.tiktok.com/" target="_blank"><img src="imagenes/icono_tiktok.webp" alt="Tik Tok" class="redes"></a>
		</div>
		<div>
		<li class="legales"><strong>©2025 Todos los derechos reservados a Club Sociedad de Fomento</strong></li>
		</div>
		<div>
		<ul id="sobre_nosotros_footer">
			<li><strong>Integrantes del Grupo: </strong>Santiago Di Virgilio, Mateo Álvarez San Juan, Martín Castaño, Agustín Dotto</li>
		</ul>
		</div>
		</div>
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