<?php
include_once './vendor/autoload.php';

use Dotenv\Dotenv;
use Persec\KSherSdkV2\Entities\Channel;
use Persec\KSherSdkV2\Entities\OrderCancelParams;
use Persec\KSherSdkV2\Entities\OrderCreateParams;
use Persec\KSherSdkV2\Entities\OrderQueryParams;
use Persec\KSherSdkV2\Entities\OrderRefundParams;
use Persec\KSherSdkV2\Exceptions\RequestException;
use Persec\KSherSdkV2\PaySdk;

$dotenv = Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

$host = $_ENV['KS_HOST'];
$token = $_ENV['KS_TOKEN'];
$debug = $_ENV['KS_DEBUG'] === 'true';
$mid = $_ENV['KS_MID'];
$sdk = new PaySdk($host, $token, $debug);

/**
 * @param PaySdk $sdk
 * @param string $orderId
 * @param int $amount
 * @return string|null
 * @throws RequestException
 * @throws \Persec\KSherSdkV2\Exceptions\RuntimeException
 */
function createOrder(PaySdk $sdk, string $orderId, int $amount): ?string
{
    $order = new OrderCreateParams(
        $orderId,
        $amount,
        'https://test.com/success',
        'https://test.com/failed',
        Channel::PromptPay,
        'test'
    );
    return $sdk->orderCreate($order);
}

/**
 * @param PaySdk $sdk
 * @param string $orderId
 * @return string|null
 * @throws RequestException
 * @throws \Persec\KSherSdkV2\Exceptions\RuntimeException
 */
function queryOrder(PaySdk $sdk, string $orderId): ?string
{
    $params = new OrderQueryParams();
    return $sdk->orderQuery($orderId, $params);
}

/**
 * @param PaySdk $sdk
 * @param string $orderId
 * @param int $amount
 * @param string $mid
 * @return string|null
 * @throws RequestException
 * @throws \Persec\KSherSdkV2\Exceptions\RuntimeException
 */
function refundOrder(PaySdk $sdk, string $orderId, int $amount, string $mid): ?string
{
    $params = new OrderRefundParams($amount, $orderId, $mid);
    return $sdk->orderRefund($orderId, $params);
}

/**
 * @param PaySdk $sdk
 * @param string $orderId
 * @param string $mid
 * @return string|null
 * @throws RequestException
 * @throws \Persec\KSherSdkV2\Exceptions\RuntimeException
 */
function cancelOrder(PaySdk $sdk, string $orderId, string $mid): ?string
{
    $params = new OrderCancelParams($mid);
    return $sdk->orderCancel($orderId, $params);
}

try {
    $orderId = '0007';
    $amount = 10000;
    $order = createOrder($sdk, $orderId, $amount);
    echo "order success\n";
    var_export($order);
    echo "=============\n\n\n\n";

//    $refundStatus = cancelOrder($sdk, $orderId, $mid);
//    echo "cancel status \n\n";
//    var_export($refundStatus);

    echo "=============\n\n\n\n";
    echo "query order\n";
    $queryRes = queryOrder($sdk, $orderId);
    var_export($queryRes);
    echo "=============\n\n\n\n";
} catch (Exception $e) {
    echo "order failed\n";
    echo $e->getMessage();
}
