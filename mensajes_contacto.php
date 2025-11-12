<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>

<?php 
session_start(); // Iniciar la sesión

// Importar clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require 'vendor/autoload.php';

// Captura de datos del formulario
$nombre = htmlspecialchars(trim($_POST['nombre']));
$email_remitente = htmlspecialchars(trim($_POST['email']));
$telefono = htmlspecialchars(trim($_POST['telefono']));
$comentario = htmlspecialchars(trim($_POST['comentario']));
$fecha_envio = date('Y-m-d');

// Guardar en la base de datos
include("conexion.php");
$_SESSION['VARIABLE'] = session_id();

$consulta = mysqli_query($conexion, "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje, fecha_envio, estado) VALUES('$nombre','$email_remitente','$telefono','$comentario', '$fecha_envio','Sin Resolver')");


// Iniciar PHPMailer
$mail = new PHPMailer(true);

try {
    // HABILITAR DEBUG DETALLADO
    $mail->SMTPDebug = 2; // Muestra toda la conversación SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'santiagodivirgilio073@gmail.com'; // TU CORREO DE GMAIL
    $mail->Password   = 'TU_CONTRASEÑA_DE_APLICACION'; // ¡¡¡REEMPLAZA ESTO CON TU CONTRASEÑA DE APLICACIÓN!!!
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet = 'UTF-8';


    // Destinatarios
    $mail->setFrom($email_remitente, $nombre);
    $mail->addAddress('santiagodivirgilio073@gmail.com', 'Santiago Divirgilio'); // El email que recibirá el mensaje
    $mail->addReplyTo($email_remitente, $nombre);

    // Contenido del correo
    $mail->isHTML(false); // Enviar como texto plano
    $mail->Subject = 'Nuevo mensaje de contacto desde la web';
    
    $cuerpo_mensaje = "Has recibido un nuevo mensaje de contacto:\n\n";
    $cuerpo_mensaje .= "Nombre: " . $nombre . "\n";
    $cuerpo_mensaje .= "Email: " . $email_remitente . "\n";
    $cuerpo_mensaje .= "Teléfono: " . $telefono . "\n\n";
    $cuerpo_mensaje .= "Mensaje:\n" . $comentario;

    $mail->Body = $cuerpo_mensaje;

    $mail->send();
    
    // Si el envío es exitoso, redirigir
    echo "Correo enviado exitosamente. Redirigiendo...";
    header("Location: contacto.php?status=success");
    exit();

} catch (Exception $e) {
    // Si hay un error, mostrarlo
    echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
?>  

</body>
</html>