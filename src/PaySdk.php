<?php

namespace Persec\KSherSdkV2;

use Persec\KSherSdkV2\Entities\OrderCancelParams;
use Persec\KSherSdkV2\Entities\OrderCreateParams;
use Persec\KSherSdkV2\Entities\OrderCreateResponse;
use Persec\KSherSdkV2\Entities\OrderQueryParams;
use Persec\KSherSdkV2\Entities\OrderQueryResponse;
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
        $this->request = new Request($debug);
    }

    private function getURL(string $path): string
    {
        return $this->host.$path;
    }

    private function getEndpoint(string $path): string
    {
        return self::API.$path;
    }

    private function prepareData($url, $object) : array
    {
        $prepare = (array) $object;
        $prepare[$this->KEY_SIGNATURE] = $this->getSignature($url, $prepare);
        return $prepare;
    }

    /**
     * @param OrderCreateParams $order
     * @return OrderCreateResponse|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderCreate(OrderCreateParams $order): ?OrderCreateResponse
    {
        $endpoint = $this->getEndpoint('/');
        $url = $this->getURL($endpoint);
        $prepareData = $this->prepareData($endpoint, $order);
        $res = $this->request->post($url, $prepareData, ['Content-Type: application/json']);
        if (empty($res)) {
            return null;
        }
        $json = json_decode($res, true);
        return new OrderCreateResponse($json);
    }

    /**
     * @param string $orderId
     * @param OrderQueryParams $params
     * @return OrderQueryResponse|null
     * @throws Exceptions\RequestException
     * @throws Exceptions\RuntimeException
     */
    public function orderQuery(string $orderId, OrderQueryParams $params): ?OrderQueryResponse
    {
        $endpoint = $this->getEndpoint("/$orderId");
        $url = $this->getURL($endpoint);
        $prepareData = $this->prepareData($endpoint, $params);
        $res = $this->request->get($url, $prepareData);
        if (empty($res)) {
            return null;
        }
        $json = json_decode($res, true);
        return new OrderQueryResponse($json);
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
        $endpoint = $this->getEndpoint("/$orderId");
        $url = $this->getURL($endpoint);
        $prepareData = $this->prepareData($endpoint, $data);
        return $this->request->put($url, $prepareData, ['Content-Type: application/json']);
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
        $endpoint = $this->getEndpoint("/$orderId");
        $url = $this->getURL($endpoint);
        $prepareData = $this->prepareData($endpoint, $params);
        return $this->request->delete($url, $prepareData, ['Content-Type: application/json']);
    }
}
