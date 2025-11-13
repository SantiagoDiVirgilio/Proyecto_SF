
<?php

include("conexion.php");
session_start();
ob_start();
require __DIR__ . '/vendor/autoload.php'; 

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

MercadoPagoConfig::setAccessToken("APP_USR-2782007117684649-102607-32961f43b793a3bc8b5805d6f726606e-2946101958");

if (!isset($_GET['id_cancha'])) { 
    exit("Error: falta el parámetro id_cancha");
}
if (!isset($_GET['id_reserva'])) { 
    exit("Error: falta el parámetro id_reserva");
}
$id_cancha = intval($_GET['id_cancha']);
$id_reserva = intval($_GET['id_reserva']);

$query = "SELECT nombre,precio_hora FROM canchas WHERE id_cancha = ?"; 
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_cancha);
$stmt->execute();
$result = $stmt->get_result();
$cancha = $result->fetch_assoc();

if (!$cancha) {
    die("Error: Cancha no encontrada");
}

// Construimos la URL de éxito incluyendo el id_reserva como parámetro
$success_url = "https://localhost/Pro/Graffo/success.php?id_reserva=" . urlencode($id_reserva);
$failure_url = "http://localhost/pro/Graffo/failure.php";
$pending_url = "http://localhost/pro/Graffo/pending.php";

$fechaActual = new DateTime();
// Preparamos los datos para external_reference
$external_reference_data = json_encode([
    'id_reserva' => $id_reserva,
    'monto' => floatval($cancha['precio_hora']),
    'date'=> $fechaActual->format('d/m/Y H:i:s')
]);
$client = new PreferenceClient();

    $preference = $client->create([
    "items" => [
        [
            "title" => $cancha['nombre'],
            "quantity" => 1,
            "currency_id" => "ARS",
            "unit_price" => floatval($cancha['precio_hora'])
        ]
     ],
    "back_urls" => [
        "success" => $success_url,
        "failure" => $failure_url,
        "pending" => $pending_url
    ],
    "external_reference" => $external_reference_data
    ]);
$preference->auto_return = "approved";
$_SESSION['preference_id'] = $preference->id;
ob_end_clean();
header('Content-Type: application/json');
echo json_encode([
    'preference_id' => $preference->id,
    'init_point' => $preference->init_point
]);
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>