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
    include("conexion.php");

    $collection_id = $_GET['collection_id'];
    $collection_status = $_GET['collection_status'];
    $payment_id = $_GET['payment_id'];
    $status = $_GET['status'];
    $preference_id = $_GET['preference_id'];
    $external_reference_json = $_GET['external_reference'] ?? null;

    $id_reserva = null;
    $monto = null;

    // 1. Decodificar el JSON de external_reference
    if ($external_reference_json) {
        $data = json_decode($external_reference_json, true);
        // Verificar si la decodificación fue exitosa y las claves existen
        if (is_array($data) && isset($data['id_reserva'])) {
            $id_reserva = $data['id_reserva'];
            $monto = $data['monto'][0] ?? null; // monto es un array en tu JSON
        }
    }

    // 2. Actualizar el estado de la reserva a 'Confirmada' si el pago fue aprobado
    if ($status === 'approved' && $id_reserva && $monto !== null) {
        // Actualizamos la tabla 'reservas' para marcarla como confirmada y guardar el monto
        $sql_update_reserva = "UPDATE reservas SET monto = ?, estado = 'Confirmada'WHERE id_reserva = ?";
        $stmt_reserva = mysqli_prepare($conexion, $sql_update_reserva);
        mysqli_stmt_bind_param($stmt_reserva, "di", $monto, $id_reserva);
        mysqli_stmt_execute($stmt_reserva);
        mysqli_stmt_close($stmt_reserva);

      
        // Actualizamos la tabla 'pagos' con el estado y el monto final
        $sql_update_pago = "UPDATE pagos SET estado = ? WHERE id_reserva = ?";
        $stmt_pago = mysqli_prepare($conexion, $sql_update_pago);
        mysqli_stmt_bind_param($stmt_pago, "si", $status, $id_reserva);
        mysqli_stmt_execute($stmt_pago);
        mysqli_stmt_close($stmt_pago);
  
    }

    echo "<p>ID de Colección: " . htmlspecialchars($collection_id) . "</p>";
    echo "<p>Estado de la Colección: " . htmlspecialchars($collection_status) . "</p>";
    echo "<p>ID de Pago: " . htmlspecialchars($payment_id) . "</p>";
    echo "<p>Estado del Pago: " . htmlspecialchars($status) . "</p>";
    echo "<p>ID de Preferencia: " . htmlspecialchars($preference_id) . "</p>";
    echo "<p>ID de Reserva (desde external_reference): " . htmlspecialchars($id_reserva) . "</p>";
    echo "<p>Monto (desde external_reference): " . htmlspecialchars($monto) . "</p>";
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