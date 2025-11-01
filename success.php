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
    <h1>SUCCESS</h1>
    <p>¡Tu pago ha sido procesado con éxito!</p>
    <p>Gracias por tu compra.</p>
    <?php
  
    $collection_id = $_GET['collection_id'];
    $collection_status = $_GET['collection_status'];
    $payment_id = $_GET['payment_id'];
    $status = $_GET['status'];
    $preference_id = $_GET['preference_id'];
    $external_reference = $_GET['external_reference']; // sera necesario?

    echo "<p>ID de Colección: " . htmlspecialchars($collection_id) . "</p>";
    echo "<p>Estado de la Colección: " . htmlspecialchars($collection_status) . "</p>";
    echo "<p>ID de Pago: " . htmlspecialchars($payment_id) . "</p>";
    echo "<p>Estado del Pago: " . htmlspecialchars($status) . "</p>";
    echo "<p>ID de Preferencia: " . htmlspecialchars($preference_id) . "</p>";
    echo "<p>Referencia Externa: " . htmlspecialchars($external_reference) . "</p>";
    ?>
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