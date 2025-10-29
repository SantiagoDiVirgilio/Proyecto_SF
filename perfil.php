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
        $id = $_SESSION['ID'];
    }

    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario='$id'");
    $resultado = mysqli_fetch_assoc($consulta);
    ?>
</article>

<article class="perfil">
        <h2> Nombre: <?php echo htmlspecialchars($resultado['nombre']); ?>
         <br>Rol de Usuario: <?php echo htmlspecialchars($resultado['rol']); ?>
         <br>Mail: <?php echo htmlspecialchars($resultado['email']); ?>
         <br>DNI: <?php echo htmlspecialchars($resultado['dni']); ?>
         <br>Telefono: <?php echo htmlspecialchars($resultado['telefono']); ?>
         <br>Fecha de Alta: <?php echo htmlspecialchars($resultado['fecha_alta']); ?>
    <!-- <br><a href="modificar_usuario_formu.php?ID=<?php echo $resultado["id_usuario"];?>">Editar</a> --> 
         </h2>
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
</body>

</html>