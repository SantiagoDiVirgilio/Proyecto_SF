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
	    include("conexion.php");
	    $llamado_canchas = mysqli_query($conexion, "SELECT * FROM canchas");
	    ?>
	
	    <?php
	    if (isset($_SESSION['mensaje'])) {
	        echo '<div class="message">' . $_SESSION['mensaje'] . '</div>';
	        unset($_SESSION['mensaje']); // Clear the message after displaying it
	    }
	    ?>
	
		<div class="mobile-header-bar">	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>

	<div class="tablas">
			<article id="tab1">
            <table>
                <thead>
                </thead>
                    <tr>
                        <td><a class="btn-añadir-deporte" href="formu_cancha.php">AÑADIR NUEVO</a></td>
                    </tr>
                </table>

                <table>
                    <thead>
                        <th class="tabla_cancha">Nombre</th>
                        <th class="tabla_cancha">Deporte Jugado</th>
                        <th class="tabla_cancha">Descripcion</th>
                        <th class="tabla_cancha">Precio Por Hora</th>
                        <th class="tabla-deporte">Acciones</th>
                    </thead>
                    <?php while($var_canchas = mysqli_fetch_assoc($llamado_canchas)){?>
                    <tr>
                        <td class="tabla_cancha"><?php echo $var_canchas["nombre"];?></td>
                        <td class="tabla_cancha"><?php echo $var_canchas["tipo"];?></td>
                        <td class="tabla_cancha"><?php echo $var_canchas["descripcion"];?></td>
                        <td class="tabla_cancha"><?php echo $var_canchas["precio_hora"];?></td>
                        <td>
                            <a class="btn-editar-deporte" href="darbaja_cancha.php?id_cancha=<?php echo $var_canchas["id_cancha"];?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cancha?');">Eliminar</a>
                            <a class="btn-editar-deporte" href="modificar_cancha_formu.php?id_cancha=<?php echo $var_canchas["id_cancha"];?>">Modificar</a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
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