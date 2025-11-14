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

        // Lógica de búsqueda
        $buscar = isset($_GET['buscar_usuario']) ? $_GET['buscar_usuario'] : '';
        $query = "SELECT * FROM usuarios";
        if (!empty($buscar)) {
            $buscar_seguro = mysqli_real_escape_string($conexion, $buscar);
            $query .= " WHERE nombre LIKE '%$buscar_seguro%'";
        }
	    $llamado_usuarios = mysqli_query($conexion, $query);
	    ?>
	
	    <?php
	    if (isset($_SESSION['mensaje'])) {
	        echo '<div class="mensaje-exito">' . $_SESSION['mensaje'] . '</div>';
	        unset($_SESSION['mensaje']); 
	    }
	    ?>
	
		<div class="mobile-header-bar">	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
	<div class="tablas">
        <div class="cajabuscar">
            <form method="get" id="buscarform" action="usuarios_tablas.php">
                <fieldset>
                    <input type="search" id="s" name="buscar_usuario" placeholder="Buscar por nombre..." value="<?php echo htmlspecialchars($buscar); ?>" />
                    <input class="button" type="submit" value="">
                </fieldset>
            </form>
        </div>
			<article id="tab1">
            <table>
                <thead>
                </thead>
                    <tr>
                        <td><a class="btn-añadir-deporte" href="registro_nuevo.php">AÑADIR NUEVO</a></td>
                    </tr>
                </table>

                <?php if ($llamado_usuarios && mysqli_num_rows($llamado_usuarios) > 0): ?>
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
                    <?php while($var_usuarios = mysqli_fetch_assoc($llamado_usuarios)){?>
                    <tr>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["nombre"]);?></td>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["dni"]);?></td>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["email"]);?></td>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["telefono"]);?></td>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["fecha_alta"]);?></td>
                        <td class="tabla-usuario"><?php echo htmlspecialchars($var_usuarios["rol"]);?></td>
                        <td>
                            <a class="btn-editar-deporte" href="darbaja_usuario.php?id_usuario=<?php echo $var_usuarios["id_usuario"];?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                            <a class="btn-editar-deporte" href="modificar_usuario_formu.php?id_usuario=<?php echo $var_usuarios["id_usuario"];?>">Modificar</a>
                        </td>
                    </tr>
                    <?php }?>
                </table>
                <?php else: ?>
                    <p>No se encontraron usuarios.</p>
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