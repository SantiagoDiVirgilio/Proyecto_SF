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
	$_SESSION['VARIABLE'] = session_id();

$id = $_GET['id_usuario'];
$conexion_usuario= mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario = '$id'");
$usuario = mysqli_fetch_array($conexion_usuario);
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>

	<article >
    <section class="formu">
        <h3>Edicion de Rol</h3><br>
	<form action="modificar_usuario.php" method="post">
        <div class="form-group">
            <input type="hidden" name="id_usuario" value="<?php echo $usuario["id_usuario"]?>" />
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" maxlength="12" value="<?php echo $usuario["nombre"]?>" />
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" maxlength="12" value="<?php echo $usuario["dni"]?>" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $usuario["email"]?>" />
        </div>
        <div class="form-group">
            <label for="telefono">Telefono:</label>
            <input type="text" name="telefono" value="<?php echo $usuario["telefono"]?>" />
        </div>
        <div class="form-group">
            <label for="fecha_alta">Fecha de alta:</label>
            <input type="text" name="fecha_alta" value="<?php echo $usuario["fecha_alta"]?>" />
        </div>
        <?php if (isset($_SESSION['ROL']) && (strtolower($_SESSION['ROL']) == 'admin')) {
                echo '

            <label for="rol">Actualizar Rol a Administrador:</label>
            <input type="radio" id="rol" name="rol" value="Admin">Admin</input>
            <label for="rol">Actualizar Rol a Usuario:</label>
            <input type="radio" id="rol" name="rol" value="Usuario">Usuario</input>';
        }
        ?>
        </div>

        <div class="form-buttons">
            <input id="Enviar" type="submit" value="Enviar">
            <input id="Resetear" type="reset" value="Resetear Información">
        </div>
    </form>
    </section>
</article>

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