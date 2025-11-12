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
    <!-- AÑADIDO: Estilos del modal directamente en el archivo para garantizar su funcionamiento -->
    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999; /* Z-index más alto */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        overflow: auto; /* Permitir scroll si es necesario */
    }
    
    .modal.visible {
        display: flex !important; /* Forzar con !important */
        justify-content: center;
        align-items: center;
    }
    
    .modal-contenido {
        background-color: #fefefe;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 1300px;
        position: relative;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        margin: 20px auto;
    }
    
    .cerrar {
        color: #aaa;
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        z-index: 10000;
    }
    
    .cerrar:hover,
    .cerrar:focus {
        color: #000;
    }
</style>
</head>

<body>
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	<?php
    include("NAV.php");
    include("conexion.php");
    
        $es_admin = false;
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $stmt_admin = mysqli_prepare($conexion, "SELECT rol FROM usuarios WHERE id_usuario = ?");
            mysqli_stmt_bind_param($stmt_admin, "i", $id_usuario);
            mysqli_stmt_execute($stmt_admin);
            $result_admin = mysqli_stmt_get_result($stmt_admin);
            $usuario = mysqli_fetch_assoc($result_admin);
            if ($usuario && (strtolower($usuario['rol']) === 'admin')) {
                $es_admin = true;
            }
            mysqli_stmt_close($stmt_admin);
        }
    ?>
    <div class="mobile-header-bar">
        <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
    </div>
    </header>
<?php
        $conexdeportes = mysqli_query($conexion, "SELECT * FROM deportes");
?>
<!-- Llamamos a la base de datos para que cargue tanto, el tipo de deporte como las canchas de dicho 
        deporte-->
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
        <?php while($deportes = mysqli_fetch_assoc($conexdeportes)){?>
            <section class="titulo_deportes" id="<?php echo htmlspecialchars($deportes["nombre"]); ?>">
                <h2><span><?php echo htmlspecialchars($deportes["nombre"]); ?></span></h2>
                <div class="canchas-container">
                    <?php $canchas = mysqli_query($conexion, "SELECT * FROM canchas"); ?>
                    <?php $horarioscanchas = mysqli_query($conexion, "SELECT * FROM horario_cancha");
                    $varhorarios = mysqli_fetch_assoc($horarioscanchas);?>
                    <?php while($varcanchas = mysqli_fetch_assoc($canchas)){?>
                    
                        <?php if($varcanchas["tipo"] == $deportes["nombre"]){?>
                            <div class="cancha-card">
                                <img src="imagenes/<?php echo $varcanchas['tipo'].'.png'; ?>" alt="<?php echo $varcanchas['nombre']; ?>">
                            <div class="cancha-card-body">
                                <h4><?php echo $varcanchas["nombre"]; ?></h4>
                                <p><?php echo $varcanchas["descripcion"]; ?></p>
                                <p class="precio"><?php echo $varcanchas["precio_hora"]; ?></p>
                                <button class="btn-ver-horarios js-abrir-calendario" data-cancha-id="<?php echo $varcanchas['id_cancha']; ?>" data-cancha-nombre="<?php echo htmlspecialchars($varcanchas['nombre'], ENT_QUOTES); ?>">Ver Horarios</button>
                            </div>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
            </section>
        <?php }?>

<!-- AÑADIDO: HTML del modal para el calendario -->
<div id="miModal" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" id="btnCerrarModal">&times;</span>
        <h2>Selecciona un Horario</h2>
        <!-- El iframe donde se cargará el calendario -->
        <iframe id="calendarioFrame" style="width: 100%; height: 600px; border: none;"></iframe>
    </div>
</div>


<footer>
<?php
    include("FOOTER.php");
?>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
    // Espera a que todo el documento HTML esté cargado y listo
    document.addEventListener('DOMContentLoaded', function() {

        // --- Lógica del Modal ---
        const modal = document.getElementById("miModal");
        const btnCerrar = document.getElementById("btnCerrarModal");
        const iframe = document.getElementById("calendarioFrame");
        const botonesAbrir = document.querySelectorAll(".js-abrir-calendario");

        function abrirModal(canchaId) {
            if (!modal || !iframe) {
                console.error("El modal o el iframe no se encontraron en el DOM.");
                return;
            }
            iframe.src = `Calendario.php?id_cancha=${canchaId}&modal=true`;
            modal.classList.add("visible");
        }

        function cerrarModal() {
            if (!modal || !iframe) return;
            modal.classList.remove("visible");
            iframe.src = "about:blank";
        }

        // Asignar el evento de clic a CADA botón "Ver Horarios"
        botonesAbrir.forEach(function(boton) {
            boton.addEventListener("click", function() {
                const canchaId = this.getAttribute("data-cancha-id");
                abrirModal(canchaId);
            });
        });

        // Evento para cerrar con el botón 'X'
        if (btnCerrar) {
            btnCerrar.addEventListener("click", cerrarModal);
        }

        // Evento para cerrar haciendo clic fuera del contenido
        if (modal) {
            modal.addEventListener("click", function(event) {
                if (event.target === modal) {
                    cerrarModal();
                }
            });
        }

        // Función global para que el iframe pueda cerrar el modal
        window.closeCalendarioModal = cerrarModal;
    }
);
</script>

</body>

</html>