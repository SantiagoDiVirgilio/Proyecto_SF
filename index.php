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
		</div>
		<div class="columna-imagen">
			<img src="imagenes/fondo_inicio.webp" alt="Imagen del club">
		</div>
	</div>
	<div>
		
	<article>
		<h3></h3>
		<ul>
		<section class="personajes-list">
			<div class="info_integrantes">
			<img class="foto_integrantes" src="imagenes/Mateo.webp" alt="Icono de Loki">
				<p><strong><u><i>Mateo Alvarez San Juan:</i></u></strong>Tras los eventos de <i>Avengers Endgame</i>, donde roba el Teseracto y crea una línea temporal alternativa, 
				<br>es capturado por la <i>Agencia de Variación Temporal (TVA)</i>, una organización que mantiene la línea temporal sagrada. Obligado a colaborar con la TVA para atrapar a otra variante, Loki descubre la verdad detrás de la TVA y 
				el control del tiempo, enfrentándose a dilemas existenciales y al multiverso que él mismo ayudó a crear.
				<br>al final, Loki se sacrifica para salvar a Sylvie y el universo, y la línea del tiempo se fractura, llevando al nacimiento del multiverso. La TVA se encuentra al borde del colapso, y las líneas temporales se multiplican 
				sin control. 
				<br>Loki debe evitar que el Telar (el dispositivo que mantiene la línea temporal) se sobrecargue y destruya todo, sin embargo fracasa, y Loki asume la tarea de mantener las líneas temporales en una estructura en forma de árbol, 
				convirtiéndose en el guardián solitario del tiempo. 
				</p>
			</div>
		</section>
		<div class="info_integrantes">
			<img class="foto_integrantes" src="imagenes/Martin.webp" alt="Icono de Loki">
				<p><strong><u><i>Martin Rodolfo Castaño:</i></u></strong>Tras los eventos de <i>Avengers Endgame</i>, donde roba el Teseracto y crea una línea temporal alternativa, 
				<br>es capturado por la <i>Agencia de Variación Temporal (TVA)</i>, una organización que mantiene la línea temporal sagrada. Obligado a colaborar con la TVA para atrapar a otra variante, Loki descubre la verdad detrás de la TVA y 
				el control del tiempo, enfrentándose a dilemas existenciales y al multiverso que él mismo ayudó a crear.
				<br>al final, Loki se sacrifica para salvar a Sylvie y el universo, y la línea del tiempo se fractura, llevando al nacimiento del multiverso. La TVA se encuentra al borde del colapso, y las líneas temporales se multiplican 
				sin control. 
				<br>Loki debe evitar que el Telar (el dispositivo que mantiene la línea temporal) se sobrecargue y destruya todo, sin embargo fracasa, y Loki asume la tarea de mantener las líneas temporales en una estructura en forma de árbol, 
				convirtiéndose en el guardián solitario del tiempo. 
				</p>
			</div>
			<div class="info_integrantes">
			<img class="foto_integrantes" src="imagenes/Agustin.webp" alt="Icono de Loki">
				<p><strong><u><i>Agustin Dotto:</i></u></strong>Tras los eventos de <i>Avengers Endgame</i>, donde roba el Teseracto y crea una línea temporal alternativa, 
				<br>es capturado por la <i>Agencia de Variación Temporal (TVA)</i>, una organización que mantiene la línea temporal sagrada. Obligado a colaborar con la TVA para atrapar a otra variante, Loki descubre la verdad detrás de la TVA y 
				el control del tiempo, enfrentándose a dilemas existenciales y al multiverso que él mismo ayudó a crear.
				<br>al final, Loki se sacrifica para salvar a Sylvie y el universo, y la línea del tiempo se fractura, llevando al nacimiento del multiverso. La TVA se encuentra al borde del colapso, y las líneas temporales se multiplican 
				sin control. 
				<br>Loki debe evitar que el Telar (el dispositivo que mantiene la línea temporal) se sobrecargue y destruya todo, sin embargo fracasa, y Loki asume la tarea de mantener las líneas temporales en una estructura en forma de árbol, 
				convirtiéndose en el guardián solitario del tiempo. 
				</p>
			</div>
			<div class="info_integrantes">
			<img class="foto_integrantes" src="imagenes/Santiago.webp" alt="Icono de Loki">
				<a href="https://www.linkedin.com/in/santiago-ezequiel-di-virgilio-a8569b319/" target="_blank"><strong><u><i>Santiago Ezequiel Di Virgilio:</i></u></strong></a>
				<p>Tras los eventos de <i>Avengers Endgame</i>, donde roba el Teseracto y crea una línea temporal alternativa, 
				<br>es capturado por la <i>Agencia de Variación Temporal (TVA)</i>, una organización que mantiene la línea temporal sagrada. Obligado a colaborar con la TVA para atrapar a otra variante, Loki descubre la verdad detrás de la TVA y 
				el control del tiempo, enfrentándose a dilemas existenciales y al multiverso que él mismo ayudó a crear.
				<br>al final, Loki se sacrifica para salvar a Sylvie y el universo, y la línea del tiempo se fractura, llevando al nacimiento del multiverso. La TVA se encuentra al borde del colapso, y las líneas temporales se multiplican 
				sin control. 
				<br>Loki debe evitar que el Telar (el dispositivo que mantiene la línea temporal) se sobrecargue y destruya todo, sin embargo fracasa, y Loki asume la tarea de mantener las líneas temporales en una estructura en forma de árbol, 
				convirtiéndose en el guardián solitario del tiempo. 
				</p>
			</div>
		</ul> 
	</article>
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