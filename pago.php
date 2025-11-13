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
   // include("NAV.php");
    //include("conexion.php");
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
  const idCancha = <?php echo isset($_GET['id_cancha']) ? json_encode($_GET['id_cancha']) : 'null'; ?>;
  const idReserva = <?php echo isset($_GET['id_reserva']) ? json_encode($_GET['id_reserva']) : 'null'; ?>;

  url.searchParams.append('id_cancha', idCancha);
  url.searchParams.append('id_reserva', idReserva);

  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.preference_id) {
        // 1. Renderizar el botón de pago de Mercado Pago
        renderWalletBrick(data.preference_id);

        // 2. Llamar a manejo_pago.php para crear el registro de pago en nuestra BD
        const formData = new FormData();
        formData.append('id_reserva', idReserva);
        formData.append('preference_id', data.preference_id); // <-- AÑADIDO: Enviamos el preference_id

        fetch('manejo_pago.php', {
          method: 'POST',
          body: new URLSearchParams(formData) // Usamos URLSearchParams para formato x-www-form-urlencoded
        })
        .then(response => response.json())
        .then(pagoData => {
          if (pagoData.success) {
            // Mostramos el ID de pago de nuestra BD y el de Mercado Pago
            document.getElementById("miParrafo").innerHTML = `ID de Pago Interno: ${pagoData.id_pago} <br> ID de Preferencia de MP: ${data.preference_id}`;
          } else {
            document.getElementById("miParrafo").innerHTML = "Error al registrar el pago en el sistema: " + pagoData.message;
          }
        });

      } else {
        console.error('Error: preference_id no encontrado en la respuesta');
        document.getElementById("miParrafo").innerHTML = "Error al generar la preferencia de pago.";
      }
    })
    .catch(error => {
      console.error('Error al obtener preference_id:', error);
      document.getElementById("miParrafo").innerHTML = "Error de conexión al generar la preferencia de pago.";
    });
</script>
<p id="miParrafo"></p>
<div id="walletBrick_container"></div>
<footer>
<?php
    //include("FOOTER.php");
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

   