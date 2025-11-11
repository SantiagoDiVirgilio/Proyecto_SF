<?php
session_start();
include("conexion.php");
require_once 'vendor/autoload.php';
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
    ?>

	<div class="mobile-header-bar">
	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>

	<article >
    <section class="formu">
        <h3>CONTACTO</h3><br>
        <p>¿Quiere hacer algún comentario en cuanto a nuestra página web?<br>
                  ¡Todos sus mensajes son bienvenidos!<br>
            ¡Complete el formulario y envíelo!
        </p>
        <form action="mensajes_contacto.php" method="post">
            <label for="nom">Nombre:</label>
            <input class="input_formu" type="text" name="nombre" maxlength="20">
            <label for="tel">Telefono:</label>
            <input class="input_formu" type="text" name="telefono" maxlength="20">
            <label for="email">Email:</label>
            <input class="input_formu" type="email" name="email" maxlength="40">
            <label for="comentario">Haga su comentario <strong>aquí:</strong></label>
            <textarea class="input_formu" arows="400" cols="60" maxlength="700" name="comentario"></textarea>
        <div class="form-buttons">
            <input id="Enviar" type="submit" value="Enviar">
            <input id="Resetear" type="reset" value="Resetear Información">
        </div>
        <div class="map-container">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2594.4184902620996!2d-58.60460592514448!3d-34.64057945944432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc951c0fe2d9f5%3A0x9f1c540898efecbe!2sUTN%20HAEDO!5e1!3m2!1ses!2sar!4v1761099590832!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
        </form>
    </section>
</article>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.ejemplo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_email@ejemplo.com'; 
    $mail->Password = 'tu_contraseña';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('tu_email@ejemplo.com', 'Nombre de tu remitente');
    $mail->addAddress('destinatario@ejemplo.com', 'Nombre del destinatario');

    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body    = '<h1>Cuerpo del mensaje</h1><p>Este es un mensaje de prueba en HTML.</p>';
    $mail->AltBody = 'Este es un mensaje de texto plano para clientes que no soportan HTML.';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
}
?>
	
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