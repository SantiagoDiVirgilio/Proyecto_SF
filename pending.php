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
<style>
        /* --- CSS --- */
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }

        .modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-contenido {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            position: relative;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .cerrar {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        /* La clase que controla la visibilidad */
        .modal.visible {
            display: flex;
        }
    </style>

<body>
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	
	<?php
    include("NAV.php");
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
  
  



<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<button id="btnAbrirModal">Abrir Modal</button>

    <div id="miModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" id="btnCerrarModal">&times;</span>
            <h2>Modal Exitoso</h2>
            <p>¡Este es un modal hecho desde cero!</p>
        </div>
    </div>

    <script>
        // --- JavaScript ---
        const modal = document.getElementById("miModal");
        const btnAbrir = document.getElementById("btnAbrirModal");
        const btnCerrar = document.getElementById("btnCerrarModal");

        function abrirModal() {
            modal.classList.add("visible");
        }

        function cerrarModal() {
            modal.classList.remove("visible");
        }

        btnAbrir.addEventListener("click", abrirModal);
        btnCerrar.addEventListener("click", cerrarModal);

        // Cerrar al hacer clic fuera
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                cerrarModal();
            }
        });
    </script>
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
<footer>
<?php
    include("FOOTER.php");
?>
</footer>
</body>

</html>