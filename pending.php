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
<style>
        /* --- CSS --- */
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }

        .modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-contenido {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 1300px;
            position: relative;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }

        .cerrar {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        /* La clase que controla la visibilidad */
        .modal.visible {
            display: flex;
        }
    </style>

<body>
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	
	<?php
    include("NAV.php");
    ?>
    <?php
    // --- AÑADIDO: Lógica para obtener el id_cancha ---
    include("conexion.php");

    $id_cancha = '4'; // Valor por defecto si no se encuentra
    //$external_reference_json = $_GET['external_reference'] ?? null;
    /*
    $id_reserva = null;

    if ($external_reference_json) {
        $data = json_decode($external_reference_json, true);
        if (is_array($data) && isset($data['id_reserva'])) {
            $id_reserva = $data['id_reserva'];
        }
    }
*//*
    if ($id_reserva) {
        $stmt = mysqli_prepare($conexion, "SELECT id_cancha FROM reservas WHERE id_reserva = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_reserva);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        if ($fila = mysqli_fetch_assoc($resultado)) {
            $id_cancha = $fila['id_cancha'];
        }
        mysqli_stmt_close($stmt);
    }
    */
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
  
<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<button id="btnAbrirModal">Reintentar Reserva</button>

    <div id="miModal" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" id="btnCerrarModal">&times;</span>
            <h2>Selecciona un nuevo horario</h2>
            <!-- AÑADIDO: Iframe para cargar el calendario -->
            <iframe id="calendarioFrame" style="width: 100%; height: 600px; border: none;"></iframe>
        </div>
    </div>

    <script>
        // --- JavaScript ---
        const modal = document.getElementById("miModal");
        const btnAbrir = document.getElementById("btnAbrirModal"); // Botón para abrir
        const btnCerrar = document.getElementById("btnCerrarModal");
        const iframe = document.getElementById("calendarioFrame");

        function abrirModal() {
            modal.classList.add("visible");
            // AÑADIDO: Asignar la URL al iframe para que cargue el calendario
            iframe.src = `Calendario.php?id_cancha=<?php echo $id_cancha; ?>&modal=true`;
        }

        function cerrarModal() {
            modal.classList.remove("visible");
            // Opcional: Limpiar el iframe al cerrar para detener cualquier proceso
            iframe.src = "about:blank";
        }

        btnAbrir.addEventListener("click", abrirModal);
        btnCerrar.addEventListener("click", cerrarModal);

        // Cerrar al hacer clic fuera
        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                cerrarModal();
            }
        });

        // Función global para que el iframe pueda llamar al cerrar el modal
        // Esta función ya la tenías en Calendario.php, así que funcionará
        function closeCalendarioModal() {
            cerrarModal();
        }
    </script>
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
<footer>
<?php
    include("FOOTER.php");
    mysqli_close($conexion);
?>
</footer>
</body>

</html>