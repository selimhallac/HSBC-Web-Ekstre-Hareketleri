
# HSBC BANKA HAREKETLERİ



require_once 'HSBCService.php';

use Phpdev\HSBCService;

$associationCode = "your_association_code";
$username = "your_username";
$password = "your_password";

$hsbcService = new HSBCService($associationCode, $username, $password);

$startDate = "2025-02-05";
$endDate = "2025-02-10";

$response = $hsbcService->getAccountReport($startDate, $endDate);

if ($response['status']) {
    echo "Hesap Raporu:\n";
    print_r($response['response']);
} else {
    echo "Hata: " . $response['response'];
}
