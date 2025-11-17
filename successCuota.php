<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="icon" href="imagenes/favicon.webp" type="image/webp">
	<title>Pago Exitoso - Sociedad de Fomento</title>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link rel="stylesheet" type="text/css" href="css/success.css">
</head>

<body class="success-page">
    <div class="success-card">
        <div class="success-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <h1>¡Pago Completado!</h1>
        <p>Tu pago ha sido procesado con éxito. ¡Gracias por tu reserva!</p>
        
        <a href="#" id="btnVolver" class="btn-volver">Volver al Inicio</a>
    </div>

    <?php
    include("conexion.php");
    include("socios.php");


    $collection_id = $_GET['collection_id'] ?? null;
    $collection_status = $_GET['collection_status'] ?? null;
    $payment_id = $_GET['payment_id'] ?? null;
    $status = $_GET['status'] ?? null;
    $preference_id = $_GET['preference_id'] ?? null;
    $external_reference = $_GET['external_reference'] ?? null;

    if ($external_reference) {
        $data = json_decode($external_reference, true);
        if (isset($data['id_usuario'])) {
            $id_usuario = $data['id_usuario'];
            $monto = $data['monto'];    
        }
    }
    if ($status === 'approved' && !empty($preference_id)) {
        $socio = new Socios($conexion);
        $estado =$socio->getEstadoSocio($id_usuario);
        if( $estado['estado'] == "Activo") {
            $id_pago = $socio->AcreditarPagar($preference_id, $monto, $status);
            $socio->PagarCuotaSocio($id_usuario,$id_pago,$status);
        }else{    
            $socio->createSocio($id_usuario);
            $socio->generarCuota($id_usuario );
            $id_pago = $socio->AcreditarPagar($preference_id, $monto, $status);
            $socio->PagarCuotaSocio($id_usuario,$id_pago,$status);
        }     
    }
    ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
document.getElementById('btnVolver').addEventListener('click', function(e) {
    e.preventDefault();
    if (window.parent && typeof window.parent.closeCalendarioModal === 'function') {
        window.parent.closeCalendarioModal();
    }
    window.top.location.href = 'index.php';
});

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