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

<<<<<<< HEAD
  // Função para renderizar o botão de pagamento
  const renderWalletBrick = async (preferenceId) => {
    await bricksBuilder.create("wallet", "walletBrick_container", {
      initialization: {
        preferenceId: preferenceId,
      }
    });
  };
  // Faz a chamada para o backend para obter o preferenceId
  const url = new URL('crear_preferencia.php', window.location.origin + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')) + '/');
  url.searchParams.append('id_cancha', <?php echo isset($_GET['id_cancha']) ? json_encode($_GET['id_cancha']) : 'null'; ?>);
=======
    <form action="registro_reserva.php" method="post">
        <!-- Campo oculto para pasar el id_horario -->
        <input type="hidden" name="id_horario" value="<?php echo htmlspecialchars($_GET['id_horario']); ?>">

        <label for="nom">Nombre:</label>
        <input class="input_formu" type="text" name="nombre" maxlength="20" required>
        
        <label for="email">Email:</label>
        <input class="input_formu" type="email" name="email" maxlength="40" required>
        
        <label for="tel">Telefono:</label>
        <input class="input_formu" type="text" name="telefono" maxlength="20" required>
        
        <label for="fecha_pago">Fecha y Hora del Pago:</label>
        <input class="input_formu" type="datetime-local" id="fecha_pago" name="fecha_pago" required>

        <h4 class="pago">
            <?php if ($paymentUrl): ?>
                <a href="<?php echo htmlspecialchars($paymentUrl); ?>" target="_blank"><img src="imagenes/mercado_pago.webp" alt="Logo de mercado pago" class="logo_mp"> 
                    Pagar con Mercado Pago
                </a>
            <?php else: ?>
                <p>Error al procesar el link de pago.</p>
            <?php endif; ?>
        </h4>
        
        <input type="submit" value="Registrar Reserva">
    </form>
>>>>>>> b467ad13257f1c7889e8d20b0c25dcab57e28fe1

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
<!-- Container para o botão de pagamento -->
<div id="walletBrick_container">ESTO ES EL BOTON</div>
<!--------------------------------------- FIN SISTEMA DE PAGO ---------------------------------->
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