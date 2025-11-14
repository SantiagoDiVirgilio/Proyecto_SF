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

<article>
    <?php
   include("conexion.php");
   if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        // Si se pasa un ID por la URL, usarlo para ver otro perfil
        $id = $_GET['id'];
    } else {
        // Si no, usar el ID del usuario que inició sesión
        $id = $_SESSION['id_usuario'];
    }

    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario='$id'");
    $resultado = mysqli_fetch_assoc($consulta);
    $llamado_inscripciones = mysqli_query($conexion, "SELECT d.id_deporte, d.nombre, d.descripcion FROM inscripciones i JOIN deportes d ON i.id_deporte = d.id_deporte WHERE i.id_usuario='$id'");
    
?>
</article>

<article class="tablas">
    <div id="tab1"> 
        <table>
            <thead>
                <th class="tabla-usuario">Nombre</th>
                <th class="tabla-usuario">DNI</th>
                <th class="tabla-usuario">Email</th>
                <th class="tabla-usuario">Telefono</th>
                <th class="tabla-usuario">Fecha Alta</th>
                <th class="tabla-usuario">Rol</th>
                <th class="tabla-deporte">Acciones</th>
            </thead>
                <tr>
                <td class="tabla-usuario"><?php echo $resultado["nombre"];?></td>
                <td class="tabla-usuario"><?php echo $resultado["dni"];?></td>
                <td class="tabla-usuario"><?php echo $resultado["email"];?></td>
                <td class="tabla-usuario"><?php echo $resultado["telefono"];?></td>
                <td class="tabla-usuario"><?php echo $resultado["fecha_alta"];?></td>
                <td class="tabla-usuario"><?php echo $resultado["rol"];?></td>
                <td>
                <?php 
                if (isset($_SESSION['ROL']) && strtolower($_SESSION['ROL']) != 'admin' && $id == $_SESSION['id_usuario'] && strtolower($resultado['rol']) != 'socio') {
                    echo '<a class="btn-editar-deporte" href="hacerme_socio.php?id_usuario=' . $resultado["id_usuario"] . '" onclick="return confirm(\'Para hacerte socio, serás redirigido a la página de pago. ¿Deseas continuar?\');">¡Hacerme Socio!</a>';
                }
                ?>
                <a class="btn-editar-deporte" href="modificar_usuario_formu.php?id_usuario=<?php echo $resultado["id_usuario"];?>">Modificar</a>
                </td>
            </tr>
        </table>
        <h3>Cuotas Pendiente : </h3>
                <?php
                    include("conexion.php");
                    include("socios.php");
                 
                    $socio = new Socios($conexion);
                    $cuota= $socio->GetCuotaPendiente($resultado["id_usuario"]);
                        if ($cuota){
                            echo '<div id="walletBrick_container" ></div>';
                        }else{
                            echo '<p>No tienes cuotas pendientes</p>';
                        }; ?>
                
        <h3>Deportes inscriptos:</h3>
        <div class="tarjeta-container">
            <?php
            if (mysqli_num_rows($llamado_inscripciones) > 0) {
                while ($fila = mysqli_fetch_assoc($llamado_inscripciones)) {
            ?>
                    <div class="tarjeta">
                        <img src="imagenes/<?php echo $fila['nombre'].'.png'; ?>" alt="<?php echo $fila['nombre']; ?>">
                        <div class="tarjeta-body">
                            <h4><?php echo htmlspecialchars($fila["nombre"]); ?></h4>
                            <h5><?php echo htmlspecialchars($fila["descripcion"]); ?></h5>
                            <a href="darbaja_inscripcion.php?id_deporte=<?php echo $fila['id_deporte']; ?>&id_usuario=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas darte de baja de este deporte?');">Darse de baja</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No estás inscripto en ningún deporte.</p>";
            }
            ?>
        </div>
    </div>
</article>
<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

<script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("menu_hamburguesa");
      if (x.className === "") {
          x.className = "responsive";
        } 
      else {
          x.className = "";
        }
    }
</script>
<script>

$('ul.tabs li a:first').addClass('active');
	$('.secciones article').hide();
	$('.secciones article:first').show();

	$('ul.tabs li a').click(function(){
		$('ul.tabs li a').removeClass('active');
		$(this).addClass('active');
		$('.secciones article').hide();

		var activeTab = $(this).attr('href');
		$(activeTab).show();
		return false;
	});
</script>

<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>
<script>
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
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script src="js/mercadopago.js"></script>
<script>
        const botonPagar = document.getElementById('pagarBtn');
        const statusDiv = document.getElementById('status');
        document.addEventListener('DOMContentLoaded', (event) => {
        const container = document.getElementById('walletBrick_container');
        container.innerHTML = '<p>Cargando opciones de pago...</p>';

    fetch('crear_preferencia_socio.php?id_usuario='+ <?php echo $resultado["id_usuario"]; ?> , {
        method: 'GET' 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hubo un problema al contactar el servidor.');
        }
        return response.json(); 
    })
    .then(data => {
        const preferenceId = data.preference_id;
        if (preferenceId) {
            container.innerHTML = ''; 
            renderWalletBrick(preferenceId);
        } else {
            throw new Error('La respuesta del servidor no incluyó un ID de preferencia.');
        }
    })
    .catch(error => {
        console.error('Error al cargar el brick de pago:', error);
        container.innerHTML = 
            `<p class="mensaje-error">No se pudo cargar la opción de pago. ${error.message}</p>`;
    });
});
    </script>