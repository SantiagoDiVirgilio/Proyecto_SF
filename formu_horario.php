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
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>
    

	<article >
    <section class="formu">
        <h3>Registro de Horarios</h3><br>
	<form action="añadir_horario.php" method="post">
            <label for="id_cancha">Nombre de Cancha donde se usa:</label>
            <select name="id_cancha" required>
                <?php foreach ($canchas as $cancha): ?>
                    <option value="<?php echo htmlspecialchars($cancha['id_cancha']); ?>" <?php echo ($cancha['id_cancha'] == $horario['id_cancha']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cancha['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <div class="form-group">
            <label for="horario">Horario:</label>
            <input type="text" name="horario" maxlength="9" value="<?php echo $horario["horario"]?>" />
        </div>
        <div class="form-group">
            <label for="disponible">Disponibilidad:</label>
            <input type="text" name="disponible" value="<?php echo $horario["disponible"]?>" />
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