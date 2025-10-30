<?php
require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

// access token
MercadoPagoConfig::setAccessToken("APP_USR-2782007117684649-102607-32961f43b793a3bc8b5805d6f726606e-2946101958");

include("conexion.php");

if (!isset($_GET['id_cancha'])) {
    exit("Error: falta el parámetro id_cancha");
}
$cancha_id = intval($_GET['id_cancha']);

//$cancha_id = 1;

$query = "SELECT nombre,precio_hora FROM canchas WHERE id_cancha = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $cancha_id);
$stmt->execute();

$result = $stmt->get_result();
$cancha = $result->fetch_assoc();

if (!$cancha) {
    die("Error: Cancha no encontrada");
}
$client = new PreferenceClient();
$preference = $client->create([
    "items" => [[
        "title" => $cancha['nombre'],
        "quantity" => 1,
        "unit_price" => floatval($cancha['precio_hora'])
    ]]
]);

$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => "https://www.tu-sitio/success",
    "failure" => "https://www.tu-sitio/failure",
    "pending" => "https://www.tu-sitio/pending"
);

//$preference->auto_return = "approved";


$paymentUrl = $preference->init_point;

mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

<?php

if ($paymentUrl) {
    header("Location: " . $paymentUrl);
    exit;
} else {
    die("Error: No se pudo generar el link de pago");
}

?>
