<?php session_start(); ?>
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
	<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	<?php
    	include("NAV.php");
    	include("conexion.php");
    ?>
    <div class="mobile-header-bar">
    <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
</header>

<?php 
include("conexion.php");
$id_usuario = $_GET['id_usuario'];

echo '<h2 class="registro">¡TE HCIISTE SOCIO!</h2>';
echo('<a class="registro" href="index.php">VOLVER A INICIO</a>');
?>
<button class="btn-pago-mp"><img src="imagenes/logo_mp.webp" alt="Logo Mercado Pago"></button>
<div id="walletBrick_container">
</div>
</body>
</html>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="js/mercadopago.js"></script>
<script>
        const botonPagar = document.getElementById('pagarBtn');
        const statusDiv = document.getElementById('status');
        document.addEventListener('DOMContentLoaded', (event) => {
        const container = document.getElementById('walletBrick_container');
        container.innerHTML = '<p>Cargando opciones de pago...</p>';

    fetch('crear_preferencia_socio.php?id_usuario='+<?php echo $id_usuario; ?> , {
        method: 'GET' 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hubo un problema al contactar el servidor.');
        }
        return response.json(); 
    })
    .then(data => {
        const preferenceId = data.preference_id;
        if (preferenceId) {
            container.innerHTML = ''; 
            renderWalletBrick(preferenceId);
        } else {
            throw new Error('La respuesta del servidor no incluyó un ID de preferencia.');
        }
    })
    .catch(error => {
        console.error('Error al cargar el brick de pago:', error);
        container.innerHTML = 
            `<p class="mensaje-error">No se pudo cargar la opción de pago. ${error.message}</p>`;
    });
});
    </script>