
<?php

include("conexion.php");
session_start();
ob_start();
require __DIR__ . '/vendor/autoload.php'; 

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

MercadoPagoConfig::setAccessToken("APP_USR-2782007117684649-102607-32961f43b793a3bc8b5805d6f726606e-2946101958");

if (!isset($_GET['id_usuario']) ) {
    header('Content-Type: application/json');
    exit;
}else{
    $id_usuario = intval($_GET['id_usuario']);
}

$timezone = new DateTimeZone('America/Argentina/Buenos_Aires');
$fecha_inicio = new DateTime('now', $timezone);
$fecha_fin = new DateTime('now', $timezone);
$fecha_fin->modify('+3 minutes'); 
$fechaActual = new DateTime();

$success_url = "https://localhost/Pro/Graffo/success.php";
$failure_url = "http://localhost/pro/Graffo/failure.php";
$pending_url = "http://localhost/pro/Graffo/pending.php";

$client = new PreferenceClient();
$nom = "123";
$prec = 10;

$preference = $client->create([
    "items" => [
        [
            "title" => $nom,
            "quantity" => 1,
            "currency_id" => "ARS",
            "unit_price" => floatval($prec)
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
$_SESSION['preference_id'] = $preference->id;
ob_end_clean(); 

header('Content-Type: application/json');
echo json_encode([
    'preference_id' => $preference->id,
    'init_point' => $preference->init_point
]);
?>
