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
    include("conexion.php");
    ?>
    <div class="mobile-header-bar">
        <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
    </div>
    </header>

<?php
        include("conexion.php");
        $resultado_2 = mysqli_query($conexion, "SELECT * FROM deportes");
        $resultado_usu = mysqli_query($conexion, "SELECT * FROM usuarios");
        $variable_usu = mysqli_fetch_assoc($resultado_usu);
?>
<!-- Llamamos a la base de datos para que cargue tanto, el tipo de deporte como las canchas de dicho 
        deporte-->
        <h2 class="perfil"> 
        <?php
          if(!empty($_SESSION['VARIABLE'])){
          echo "Bienvenido"." ". $variable_usu["nombre"];
          echo"<br>";
          echo "Telefono: ".$variable_usu["telefono"];
          echo"<br>";
          echo "Gmail: ".$variable_usu["email"];
        }
          ?>
          </h2>
        <div class="canchas-container">
            <?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
                <?php if($variable_2["nombre"] != NULL && $variable_2['nombre'] != 'SALON'){?>
                    <div class="deporte-card">
                        <img src="imagenes/<?php echo $variable_2['nombre'].'.png'; ?>" alt="<?php echo $variable_2['nombre']; ?>">
                        <div class="deporte-card-body">
                            <h4><?php echo $variable_2["nombre"]; ?></h4>
                            <button class="btn-ver-horarios" data-cancha-id="<?php echo $variable_2['nombre']; ?>" data-cancha-nombre="<?php echo htmlspecialchars($variable_2['nombre'], ENT_QUOTES); ?>">Reservar</button>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>

<!-- Modal (Utiliza el mismo modal que alquileres.php)-->
<div id="horariosModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
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

<footer>
<?php
    include("FOOTER.php");
?>
</footer>

<script>
    const isLoggedIn = <?php echo json_encode(!empty($_SESSION['VARIABLE'])); ?>;
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

// --- Lógica del Modal ---
const modal = document.getElementById("horariosModal");
const modalCanchaNombre = document.getElementById("modalCanchaNombre");
const modalHorariosBody = document.getElementById("modalHorariosBody");
const closeModal = document.querySelector(".close");

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
        if (isLoggedIn) {
            const canchaNombre = event.target.getAttribute("data-cancha-nombre");
            const canchaHorario = event.target.parentElement.querySelector("p").textContent;
            openModal(canchaNombre, canchaHorario);
        } else {
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        }
    }
});

// Eventos para cerrar el modal
closeModal.addEventListener("click", closeModalFunction);
window.addEventListener("click", function(event) {
    if (event.target === modal) {
        closeModalFunction();
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>