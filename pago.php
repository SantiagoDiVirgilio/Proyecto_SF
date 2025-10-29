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
    ?>
</header>

<!--------------------------------------- SISTEMA DE PAGO ---------------------------------->
<?php
require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

// Configurar el access token
MercadoPagoConfig::setAccessToken("APP_USR-2782007117684649-102607-32961f43b793a3bc8b5805d6f726606e-2946101958");

try {
    $client = new PreferenceClient();
    
    $preference = $client->create([
        "items" => [
            [
                "title" => "PRUEBA GENERAL",
                "quantity" => 1,
                "unit_price" => 1
            ]
        ]
    ]);
    
    $paymentUrl = $preference->init_point;
    
} catch (MPApiException $e) {
    echo "Error: " . $e->getMessage();
    $paymentUrl = null;
} catch (Exception $e) {
    echo "Error general: " . $e->getMessage();
    $paymentUrl = null;
}
?>

<h4 class="pago">
<?php if ($paymentUrl): ?>
    <a href="<?php echo htmlspecialchars($paymentUrl); ?>" target="_blank"><img src="imagenes/mercado_pago.webp" alt="Logo de mercado pago" class="logo_mp"> 
        Pagar con Mercado Pago
    </a>
<?php else: ?>
    <p>Error al procesar el pago.</p>
<?php endif; ?>
</h4>

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