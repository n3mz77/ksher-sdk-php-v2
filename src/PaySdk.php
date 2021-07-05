<?php

namespace Persec\KSherSdkV2;

use Persec\KSherSdkV2\Entities\OrderCancelParams;
use Persec\KSherSdkV2\Entities\OrderCreateParams;
use Persec\KSherSdkV2\Entities\OrderQueryParams;
use Persec\KSherSdkV2\Entities\OrderRefundParams;

class PaySdk extends BaseSDK
{
    const VERSION = '0.0.1';
    const API = '/api/v1/redirect/orders';
    /**
     * @var Request $request
     */
    private $request;

    /**
     * @var string $host
     */
    private $host;

    public function __construct(string $host, string $token, $debug = false)
    {
        parent::__construct($token, $debug);
        $this->host = $host;
        $this->request = new Request();
    }

    private function getURL(string $path): string
    {
        return $this->host.self::API.$path;
    }

    /**
     * @param OrderCreateParams $order
     * @return string|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderCreate(OrderCreateParams $order): ?string
    {
        $url = $this->getURL('/');
        return $this->request->post($url, $order, ['Content-Type : "application/json"']);
    }

    /**
     * @param string $orderId
     * @param OrderQueryParams $params
     * @return string|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderQuery(string $orderId, OrderQueryParams $params): ?string
    {
        $url = $this->getURL('/');
        return $this->request->get($url, $params);
    }

    /**
     * @param string $orderId
     * @param $data
     * @return string|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderRefund(string $orderId, OrderRefundParams $data): ?string
    {
        $url = $this->getURL("/$orderId");
        return $this->request->put($url, $data, ['Content-Type : "application/json"']);
    }

    /**
     * @param string $orderId
     * @param OrderCancelParams $params
     * @return string|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderCancel(string $orderId, OrderCancelParams $params): ?string
    {
        $url = $this->getURL("/$orderId");
        return $this->request->delete($url, $params, ['Content-Type : "application/json"']);
    }
}
