<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>

<?php 
session_start(); 


require 'vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




$nombre = htmlspecialchars(trim($_POST['nombre']));
$email_remitente = htmlspecialchars(trim($_POST['email']));
$telefono = htmlspecialchars(trim($_POST['telefono']));
$comentario = htmlspecialchars(trim($_POST['comentario']));
$fecha_envio = date('Y-m-d');


include("conexion.php");
$_SESSION['VARIABLE'] = session_id();

$consulta = mysqli_query($conexion, "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje, fecha_envio, estado) VALUES('$nombre','$email_remitente','$telefono','$comentario', '$fecha_envio','Sin Resolver')");



$mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 2; 
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'agustincapi08@gmail.com'; 
    $mail->Password   = 'htdg cizu aegp ijcy'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->CharSet = 'UTF-8';


   
    $mail->setFrom('no-responder@tudominio.com', 'Formulario de contacto');
    $mail->addAddress('agustincapi08@gmail.com');
    $mail->addAddress('santiagodivirgilio073@gmail.com');  
    $mail->addReplyTo($email_remitente, $nombre);

   
    $mail->isHTML(false); 
    $mail->Subject = 'Nuevo mensaje de contacto desde la web';
    
    $cuerpo_mensaje = "Has recibido un nuevo mensaje de contacto:\n\n";
    $cuerpo_mensaje .= "Nombre: " . $nombre . "\n";
    $cuerpo_mensaje .= "Email: " . $email_remitente . "\n";
    $cuerpo_mensaje .= "Teléfono: " . $telefono . "\n\n";
    $cuerpo_mensaje .= "Mensaje:\n" . $comentario;

    $mail->Body = $cuerpo_mensaje;

    $mail->send();
    
    header("Location: contacto.php?status=success");
} catch (Exception $e) {
    header("Location: contacto.php?status=error");
    exit();
}
?>  

</body>
</html>