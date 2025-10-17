<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="icon" href="Imagenes/Favicon.png" type="image/png">
	<title>Página no encontrada - LOKI: The Fan Page</title>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Sansita:ital,wght@0,400;0,700;0,800;0,900;1,400;1,700;1,800;1,900&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body style="background-image: url('Imagenes/404.png'); display: flex; flex-direction: column; min-height: 100vh;">
	<header>
		<div class="mobile-header-bar">
			<a href="index.html"><img src="Imagenes/Logo.png" alt="Logo de la serie" class="logo"></a>
			<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
		</div>
		<nav id="myTopnav">
			<ul>
			<li><a href="index.html">Inicio</a></li>
				<div class="dropdown">
					<ul>
					<li><a>Personajes</a></li>
				<div class="dropdown-content">
					<li><a href="pagina1.html">AVT</a></li>
					<li><a href="pagina2.html">Variantes</a></li>
				</div>
			</ul>
		</div>
		<div class="dropdown">
			<ul>
			<li><a>Temporadas</a></li>
				<div class="dropdown-content">
					<li><a href="temporada1.html">Temporada 1</a></li>
					<li><a href="temporada2.html">Temporada 2</a></li>
				</div>
			</ul>
		</div>
			<li><a href="galeria.html">Galería</a></li>
			<li><a href="contacto.html">Contacto</a></li>
			</ul>
		</nav>
	</header>

	<div class="container-principal" style="flex: 1;">
		
		<div class="columna-texto-2" style="text-align: center; padding-top: 15%; padding-bottom: 15%;">
			<article>
				<h3 style="font-size: 4rem; color: rgb(96, 172, 96);">Error 404</h3>
				<p style="font-size: 1.5rem;">La página que buscas fue borrada de la Sagrada Línea del Tiempo..</p>
                <br>
				<p><a href="index.html" style="font-size: 1.2rem; text-decoration: underline;">Volver a la página de inicio</a></p>
			</article>
		</div>
	</div>

		<footer>
		<div>
			<a href="index.html"><strong>Inicio</strong></a>
		</div>
		<div>
			<h7><strong>Personajes</strong></h7>
			<br><a href="pagina1.html">AVT</a>
			<br><a href="pagina2.html">Variantes</a>
		</div>
		<div>
			<h7><strong>Temporadas</strong></h7>
			<br><a href="temporada1.html">Temporada 1</a>
			<br><a href="temporada2.html">Temporada 2</a>
		</div>
		<div>
			<a href="galeria.html"><strong>Galería</strong></a>
		</div>
		<div>
			<a href="contacto.html"><strong>Contacto</strong></a>
		</div>
		<a href="https://es-la.facebook.com/" target="_blank"><img src="Imagenes/Icono_Facebook.png" alt="Facebook" class="redes"></a>
		<a href="https://www.instagram.com/" target="_blank"><img src="Imagenes/Icono_Instagram.png" alt="Instagram" class="redes"> </a>
		<a href="https://twitter.com/i/flow/login?input_flow_data=%7B%22requested_variant%22%3A%22eyJsYW5nIjoiZXMifQ%3D%3D%22%7D" target="_blank"><img src="Imagenes/Icono_Twitter.png" alt="Twitter" class="redes"></a>
		<a href="https://www.tiktok.com/" target="_blank"><img src="Imagenes/Icono_Tiktok.png" alt="Tik Tok" class="redes"></a>
	</footer>
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