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
    //include("NAV.php");
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
    <h1>SUCCESS</h1>
    <p>¡Tu pago ha sido procesado con éxito!</p>
    <p>Gracias por tu compra.</p>
    <P>HOLA</P>
    <?php
    include("conexion.php");

    // Usar el operador de fusión de null (??) para evitar warnings si los parámetros no existen.
    $collection_id = $_GET['collection_id'] ?? null;
    $collection_status = $_GET['collection_status'] ?? null;
    $payment_id = $_GET['payment_id'] ?? null;
    $status = $_GET['status'] ?? null;
    $preference_id = $_GET['preference_id'] ?? null;
    $external_reference_json = $_GET['external_reference'] ?? null;
    $date = $_GET['date_of_expiration'] ?? null;

    echo "<p>ID de Colección: " . htmlspecialchars($collection_id) . "</p>";
    echo "<p>Estado de la Colección: " . htmlspecialchars($collection_status) . "</p>";
    echo "<p>ID de Pago: " . htmlspecialchars($payment_id) . "</p>";
    
/*
    $id_reserva = null;
    $monto = null;

    if ($external_reference) {
        $data = json_decode($external_reference_json, true);
        // Verificar si la decodificación fue exitosa y las claves existen
        if (is_array($data) && isset($data['id_reserva'])) {
            $id_reserva = $data['id_reserva'];

        }
    }
*/
    $id_reserva = null;
    if ($external_reference_json) {
        $data = json_decode($external_reference_json, true);
        if (is_array($data) && isset($data['id_reserva'])) {
            $id_reserva = $data['id_reserva'];
        }
    }

    // 2. Actualizar el estado de la reserva a 'Confirmada' si el pago fue aprobado
    if ($status === 'approved' && !empty($preference_id)) {
        // Primero, actualizamos el estado en la tabla 'pagos' usando el preference_id
        $sql_update_pago = "UPDATE pagos SET estado = ? WHERE id_preference = ?";
        $stmt_pago = mysqli_prepare($conexion, $sql_update_pago);
        // Usamos "s" para status y "s" para preference_id
        mysqli_stmt_bind_param($stmt_pago, "ss", $status, $preference_id);
        mysqli_stmt_execute($stmt_pago);
        mysqli_stmt_close($stmt_pago);

        $sql_update_reserva = "UPDATE reservas r 
                               JOIN pagos p ON r.id_pago = p.id_pago 
                               SET r.estado = 'Confirmada' 
                               WHERE p.id_preference = ?";
        $stmt_reserva = mysqli_prepare($conexion, $sql_update_reserva);
        mysqli_stmt_bind_param($stmt_reserva, "s", $preference_id);
        mysqli_stmt_execute($stmt_reserva);
        mysqli_stmt_close($stmt_reserva);
    }

    echo "<p>ID de Preferencia: " . htmlspecialchars($preference_id) . "</p>";
    echo "<p>ID de Reserva (desde external_reference): " . htmlspecialchars($id_reserva ?? 'No encontrado') . "</p>";
    echo "<p>Fecha: " . htmlspecialchars($date ?? 'No encontrada') . "</p>";
    ?>
<footer>
<?php
    //include("FOOTER.php");
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
<footer>
<?php
    //include("FOOTER.php");
?>
</footer>
