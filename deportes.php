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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </header>
<main>
<?php
        $llamado_deportes = mysqli_query($conexion, "SELECT * FROM deportes");
?>
        <h2 class="perfil"> 
        <?php
            if(isset($_SESSION['id_usuario'])){
                $id_usuario_actual = $_SESSION['id_usuario'];
                $stmt_usuario = mysqli_prepare($conexion, "SELECT nombre FROM usuarios WHERE id_usuario = ?");
                mysqli_stmt_bind_param($stmt_usuario, "i", $id_usuario_actual);
                mysqli_stmt_execute($stmt_usuario);
                $resultado_usuario = mysqli_stmt_get_result($stmt_usuario);
                if($usuario_actual = mysqli_fetch_assoc($resultado_usuario)){
                  echo "Bienvenido " . htmlspecialchars($usuario_actual["nombre"]);
                }
                mysqli_stmt_close($stmt_usuario);
            }
        ?>
          </h2>
        <div class="tarjeta-container">
            <?php while($var_deportes = mysqli_fetch_assoc($llamado_deportes)){?>
                <?php if($var_deportes["nombre"] != NULL && $var_deportes['nombre'] != 'SALON'){?>
                    <div class="tarjeta">
                        <img src="imagenes/<?php echo $var_deportes['nombre'].'.png'; ?>" alt="<?php echo $var_deportes['nombre']; ?>">
                        <div class="tarjeta-body">
                            <h4><?php echo htmlspecialchars($var_deportes["nombre"]); ?></h4>
                            <h5><?php echo htmlspecialchars($var_deportes["descripcion"]); ?></h5>
                            <button class="btn-ver-horarios" data-deporte-id="<?php echo $var_deportes['id_deporte']; ?>" data-cancha-nombre="<?php echo htmlspecialchars($var_deportes['nombre'], ENT_QUOTES); ?>">Inscribirse</button>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>

<!-- Modal (Utiliza el mismo modal que alquileres.php)-->
<div id="customHorariosModal" class="modal">
  <div class="custom-modal-content">
    <span class="custom-close">&times;</span>
    <h3 id="modalCanchaNombre"></h3>
    <div id="modalHorariosBody">
    </div>
  </div>
</div>

<!-- HTML de la Ventana Modal de Iniciar Sesion o Registrarse -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Acción Requerida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Para realizar esta acción, por favor, inicia sesión o crea una cuenta.
      </div>
      <div class="modal-footer">
        <a href="iniciar_sesion.php" class="btn btn-primary">Iniciar Sesión</a>
        <a href="registro_nuevo.php" class="btn btn-secondary">Registrarse</a>
      </div>
    </div>
  </div>
</div>
</main>
<footer>
<?php
    include("FOOTER.php");
?>
</footer>

<script>
    const isLoggedIn = <?php echo json_encode(isset($_SESSION['id_usuario'])); ?>;
</script>
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

// Funcion para abrir modal
function openModal(canchaNombre, canchaHorario) {
    modalCanchaNombre.innerText = "Horarios para: " + canchaNombre;
    modalHorariosBody.innerHTML = (canchaHorario || "No disponible");
    modal.style.display = "block";
}



// Funcion para cerrar modal
function closeModalFunction() {
    modal.style.display = "none";
}

// Evento de delegacion de modal
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-ver-horarios")) {
        console.log("Botón 'Inscribirse' clickeado.");
        console.log("isLoggedIn:", isLoggedIn);

        if (isLoggedIn) {
            const deporteId = event.target.getAttribute("data-deporte-id");
            console.log("ID de deporte:", deporteId);

            if (!deporteId) {
                alert("Error: No se pudo obtener el ID del deporte.");
                return;
            }

            const formData = new FormData();
            formData.append('id_deporte', deporteId);

            fetch('inscribir_deporte.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log("Respuesta del servidor:", response);
                return response.json();
            })
            .then(data => {
                console.log("Datos JSON de la respuesta:", data);
                if (data.success) {
                    alert('¡Inscripción exitosa!');
                } else {
                    alert('Error en la inscripción: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error en fetch:', error);
                alert('Ocurrió un error al procesar la solicitud. Revisa la consola para más detalles.');
            });
        } else {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }
    }
});

// Get Modal Elements
const modal = document.getElementById("customHorariosModal");
const closeModal = document.querySelector("#customHorariosModal .custom-close");

// Eventos para cerrar el modal
if(closeModal && modal) {
    closeModal.addEventListener("click", closeModalFunction);
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            closeModalFunction();
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>