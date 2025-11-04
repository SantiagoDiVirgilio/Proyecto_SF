<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="images/Vapor_Logo_Png.png" type="Images/png">
    <title>Vapor: The Proyect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
</head>

<body>
    <img class="fondo" src="images/fondo_formu.jpg" alt="">
<header>
    <?php
    include("NAV.php");
    ?>
</header>

<article >
    <section class="formu">
        <h3>LOGUEATE</h3>
        <br>
	<form action="login.php" method="post">
    	<label>Nombre de usuario:
        	<input name="usuario" type="text" maxlength="12" /><br>
        </label><br />
        <label>Contraseña:
        	<input type="password" name="clave" maxlength="12" /><br>
        </label><br />
        	<input type="submit" value="Login"/><br>
    </form>
    <br>
    <a href="form_registro.php">Registrate</a> si no sos usuario.
    </section>
</article>
<br><br><br><br><br><br><br><br><br><br><br>
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