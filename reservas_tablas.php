<?php
session_start();
include("conexion.php");
?>
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
	    $llamado_reservas = mysqli_query($conexion, "SELECT r.id_reserva, c.nombre AS nombre_cancha, p.estado AS pago, u.telefono, r.estado, r.fecha_reserva, r.monto, r.hora_inicio, r.hora_fin, u.nombre AS nombre_usuario FROM reservas r LEFT JOIN canchas c ON r.id_cancha = c.id_cancha LEFT JOIN usuarios u ON r.id_usuario = u.id_usuario LEFT JOIN pagos p ON r.id_pago = p.id_pago");
	    ?>
	
	    <?php
	    if (isset($_SESSION['mensaje'])) {
	        echo '<div class="message">' . $_SESSION['mensaje'] . '</div>';
	        unset($_SESSION['mensaje']);
	    }
	    ?>
	
		<div class="mobile-header-bar">	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
			<article id="tab1">
                <?php if ($llamado_reservas && mysqli_num_rows($llamado_reservas) > 0): ?>
                <table>
                    <thead>
						<th class="tabla-usuario">ID Reserva</th>
                        <th class="tabla-usuario">Cancha</th>
                        <th class="tabla-usuario">Pago</th>
                        <th class="tabla-usuario">Telefono</th>
                        <th class="tabla-usuario">Estado</th>
                        <th class="tabla-usuario">Fecha de reserva</th>
                        <th class="tabla-deporte">Monto</th>
                        <th class="tabla-deporte">Hora de Inicio</th>
                        <th class="tabla-deporte">Hora de Finalización</th>
                        <th class="tabla-deporte">Nombre de Usuario</th>
                    </thead>
                <?php while($var_reservas = mysqli_fetch_assoc($llamado_reservas)){?>
                <tr>
					<td><?php echo htmlspecialchars($var_reservas["id_reserva"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["nombre_cancha"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["pago"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["telefono"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["estado"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["fecha_reserva"]);?></td>
                    <td>$<?php echo htmlspecialchars($var_reservas["monto"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["hora_inicio"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["hora_fin"]);?></td>
                    <td><?php echo htmlspecialchars($var_reservas["nombre_usuario"]);?></td>
                </tr>
                <?php }?>
                </table>
                <?php else: ?>
                    <p>No se encontraron reservas.</p>
                <?php endif; ?>
			</article>
        </div>

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