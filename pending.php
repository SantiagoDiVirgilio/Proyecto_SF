<?php session_start(); ?><!DOCTYPE html>
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
	    <?php include("NAV.php"); ?>
	</header>

    <div class="tablas">
        <article id="tab1">
            <h2>Tu pago está pendiente</h2>
            <p>Hola, <strong><?php echo htmlspecialchars($_SESSION['NOMBRE'] ?? 'usuario'); ?></strong>. Tu pago está siendo procesado.</p>
            <p>Recibirás una notificación por correo electrónico cuando se confirme el estado final. Si lo deseas, puedes reintentar el pago con otro medio a continuación.</p>
            
            <div id="walletBrick_container"></div>
        </article>
    </div>

<footer>
    <?php include("FOOTER.php"); ?>
</footer>


<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="js/mercadopago.js"></script>

<script>
    /*
    document.addEventListener('DOMContentLoaded', (event) => {
        // Creamos un objeto para leer los parámetros de la URL actual
        const urlParams = new URLSearchParams(window.location.search);
        
        // Obtenemos el valor del parámetro 'preference_id' que envía Mercado Pago
        const preferenceId = urlParams.get('preference_id');

        if (preferenceId) {
            // Si encontramos el ID, llamamos a la función para dibujar el botón de pago
            renderWalletBrick(preferenceId);
        } else {
            document.getElementById('walletBrick_container').innerHTML = 
                `<p class="mensaje-error">No se pudo cargar la opción de pago. Falta el identificador de la preferencia.</p>`;
        }
    });
    */
</script>

</body>
</html>
<script>
        const botonPagar = document.getElementById('pagarBtn');
        const statusDiv = document.getElementById('status');
        document.addEventListener('DOMContentLoaded', (event) => {
        const container = document.getElementById('walletBrick_container');
        container.innerHTML = '<p>Cargando opciones de pago...</p>';

    fetch('crear_preferencia_socio.php', {
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