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

<div class="cajabuscar"><form method="get" id="buscarform" action="resultados_buscar.php">
    <fieldset>
        <input type="search" id="s" name="buscar_usuario" placeholder="Buscar..." required />
        <input class="button" type="submit" value="" >
    </fieldset>
</form>
</div>

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









<footer>
<?php
    include("FOOTER.php");
?>
</footer>

<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
    const esAdmin = <?php echo json_encode($es_admin); ?>;
    
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