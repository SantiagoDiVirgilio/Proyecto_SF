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
    include("conexion.php");
    /*
    session_start();
    $_SESSION['preference_id'] = $preference->id;
    */
?>
</header>
<h3>DETALLES DE LA COMPRA</h3>
<!--------------------------------------- SISTEMA DE PAGO ---------------------------------->
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
  const publicKey = "APP_USR-226856e1-5fbf-4b6b-9534-a5dbeef03d2b";
  const mp = new MercadoPago(publicKey);
  const bricksBuilder = mp.bricks();

  const renderWalletBrick = async (preferenceId) => {
    await bricksBuilder.create("wallet", "walletBrick_container", {
      initialization: {
        preferenceId: preferenceId,
      }
    });
};
  //el get id_cancha es para pasar a la preferencia para poder crear la orden de pago.
  // Faz a chamada para o backend para obter o preferenceId
  const url = new URL('crear_preferencia.php', window.location.origin + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')) + '/');
  url.searchParams.append('id_cancha', <?php echo isset($_GET['id_cancha']) ? json_encode($_GET['id_cancha']) : 'null'; ?>);

  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.preference_id) {
        renderWalletBrick(data.preference_id);
      } else {
        console.error('Error: preference_id no encontrado en la respuesta');
        // Opcional: mostrar un mensaje de error al usuario
      }
    })
    .catch(error => {
      console.error('Error al obtener preference_id:', error);
      // Opcional: mostrar un mensaje de error al usuario
    });

</script>

<div id="walletBrick_container"></div>
<footer>
<?php
    include("FOOTER.php");
?>
</footer>
</body>
</html>

<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
    const esAdmin = <?php echo json_encode($es_admin); ?>;
    
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

   