
<?php

include("conexion.php");
session_start();
ob_start();
require __DIR__ . '/vendor/autoload.php'; 

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

require_once 'mp_config.php'; 
MercadoPagoConfig::setAccessToken(MP_ACCESS_TOKEN);

if (!isset($_GET['id_usuario']) ) {
    header('Content-Type: application/json');
    exit;
}else{
    $id_usuario = intval($_GET['id_usuario']);
}
      
$timezone = new DateTimeZone('America/Argentina/Buenos_Aires');
$fecha_inicio = new DateTime('now', $timezone);
$fecha_fin = new DateTime('now', $timezone);
$fecha_fin->modify('+1 minutes'); 
$fechaActual = new DateTime();

$success_url = "https://localhost/pro/Graffo/successCuota.php";
$failure_url = "http://localhost/pro/Graffo/failure.php";
$pending_url = "http://localhost/pro/Graffo/pending.php";
include("config.php");
$monto = new Config($conexion);

$pago=$monto->GetMontoCuota();

$external_reference_data = json_encode([
        'id_usuario' => $id_usuario,
        'monto' => $pago   
        ]);
$client = new PreferenceClient();

$preference = $client->create([
    "items" => [
        [
            "title" => "cuota de socio",
            "quantity" => 1,
            "currency_id" => "ARS",
            "unit_price" => floatval($pago)
        ]
     ],
    "back_urls" => [
        "success" => $success_url,
        "failure" => $failure_url,
        "pending" => $pending_url
    ],
    "external_reference" => $external_reference_data,
    ]);
/*
 "expires" => true,
    "expiration_date_from" => $fecha_inicio->format('Y-m-d\TH:i:s.vP'),
    "expiration_date_to" => $fecha_fin->format('Y-m-d\TH:i:s.vP')
*/ 
//$preference->auto_return = "approved";
//$_SESSION['preference_id'] = $preference->id;
ob_end_clean(); 

header('Content-Type: application/json');
echo json_encode([
    'preference_id' => $preference->id,
    'init_point' => $preference->init_point
]);
?>
