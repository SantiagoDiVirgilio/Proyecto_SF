<?php
require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

// Configurar el access token
MercadoPagoConfig::setAccessToken("APP_USR-2782007117684649-102607-32961f43b793a3bc8b5805d6f726606e-2946101958");

try {
    $client = new PreferenceClient();
    
    $preference = $client->create([
        "items" => [
            [
                "title" => "Reserva de Cancha",
                "quantity" => 1,
                "unit_price" => 1500
            ]
        ]
    ]);
    
    $paymentUrl = $preference->init_point;
    
} catch (MPApiException $e) {
    echo "Error: " . $e->getMessage();
    $paymentUrl = null;
} catch (Exception $e) {
    echo "Error general: " . $e->getMessage();
    $paymentUrl = null;
}
?>

<?php if ($paymentUrl): ?>
    <a href="<?php echo htmlspecialchars($paymentUrl); ?>" target="_blank">
        Pagar con Mercado Pago
    </a>
<?php else: ?>
    <p>Error al procesar el pago.</p>
<?php endif; ?>