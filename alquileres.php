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
        }
          ?>
          </h2>
        <?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
            <section class="titulo_deportes"id="<?php echo $variable_2["nombre"]; ?>">
                    <h2 id="<?php $variable_2["nombre"]; ?>"><?php echo $variable_2["nombre"]; ?></h2> 
                <div class="canchas-container">
                    <?php $resultado_1 = mysqli_query($conexion, "SELECT * FROM canchas"); ?>
                    <?php $resultado_3 = mysqli_query($conexion, "SELECT * FROM horario_cancha");
                    $variable_3 = mysqli_fetch_assoc($resultado_3);?>
                    <?php while($variable_1 = mysqli_fetch_assoc($resultado_1)){?>
                    
                        <?php if($variable_1["tipo"] == $variable_2["nombre"]){?>
                            <div class="cancha-card">
                                <img src="imagenes/<?php echo $variable_1['tipo'].'.png'; ?>" alt="<?php echo $variable_1['nombre']; ?>">
                            <div class="cancha-card-body">
                                <h4><?php echo $variable_1["nombre"]; ?></h4>
                                <p><?php echo $variable_1["descripcion"]; ?></p>
                                <p class="precio"><?php echo $variable_1["precio_hora"]; ?></p>
                                <button class="btn-ver-horarios" data-deporte-id="<?php echo $variable_2['id_deporte']; ?>" data-cancha-nombre="<?php echo htmlspecialchars($variable_1['nombre'], ENT_QUOTES); ?>">Ver Horarios</button>
                            </div>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
            </section>
        <?php }?>

<!-- Modal -->
<div id="horariosModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 id="modalCanchaNombre"></h3>
    <div id="modalHorariosBody">
    </div>
  </div>
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

// --- Lógica del Modal ---
const modal = document.getElementById("horariosModal");
const modalCanchaNombre = document.getElementById("modalCanchaNombre");
const modalHorariosBody = document.getElementById("modalHorariosBody");
const closeModalBtn = document.querySelector(".close");

// Función para abrir el modal
function openModal() {
    modal.style.display = "block";
}

// Función para cerrar el modal
function closeModal() {
    modal.style.display = "none";
}

// Evento de delegación para los botones "Ver Horarios"
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-ver-horarios")) {
        const deporteId = event.target.getAttribute("data-deporte-id");
        const canchaNombre = event.target.getAttribute("data-cancha-nombre");

        // Actualizar el nombre de la cancha en el modal y mostrar "cargando"
        modalCanchaNombre.innerText = "Horarios para: " + canchaNombre;
        modalHorariosBody.innerHTML = "<p>Cargando horarios...</p>";
        openModal();

        // Realizar la petición fetch para obtener los horarios
        fetch(`obtener_horarios.php?id_deporte=${deporteId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    modalHorariosBody.innerHTML = `<p>${data.error}</p>`;
                    return;
                }

                let horariosHtml = "<h4>Horarios</h4>";
                if (data.length > 0) {
                    horariosHtml += "<table>";
                    horariosHtml += "<thead><tr><th>Horario</th><th>Disponibilidad</th></tr></thead>";
                    horariosHtml += "<tbody>";
                    data.forEach(item => {
                        let disponibilidad = item.disponible == 1 ? 'Disponible' : 'No Disponible';
                        let claseCss = item.disponible == 1 ? 'disponible' : 'no-disponible';
                        horariosHtml += `<tr><td>${item.horario}</td><td class="${claseCss}">${disponibilidad}</td></tr>`;
                    });
                    horariosHtml += "</tbody></table>";
                } else {
                    horariosHtml += "<p>No hay horarios definidos para este deporte.</p>";
                }
                modalHorariosBody.innerHTML = horariosHtml;
            })
            .catch(error => {
                console.error('Error al obtener los horarios:', error);
                modalHorariosBody.innerHTML = "<p>No se pudieron cargar los horarios. Intente más tarde.</p>";
            });
    }
});

// Eventos para cerrar el modal
closeModalBtn.addEventListener("click", closeModal);
window.addEventListener("click", function(event) {
    if (event.target === modal) {
        closeModal();
    }
});
</script>

</body>

</html>