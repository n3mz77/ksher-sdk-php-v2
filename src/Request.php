<?php

namespace Persec\KSherSdkV2;

use Persec\KSherSdkV2\Exceptions\RequestException;
use Persec\KSherSdkV2\Exceptions\RuntimeException;

class Request
{
    /**
     * @var bool $isDebug
     */
    private $isDebug = false;
    public function __construct(bool $isDebug = false)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param array $headers
     * @return string|null
     * @throws RuntimeException
     * @throws RequestException
     */
    private function doRequest($method, $url, array $data, $headers = []): ?string
    {
        $endpoint = $url;
        $methodUpper = strtoupper($method);
        if ($methodUpper === 'GET') {
            $queryParams = http_build_query($data);
            $endpoint = $url . "?$queryParams";
        }
        $curl = curl_init($endpoint);
        switch ($methodUpper) {
            case 'GET':
                //ignore
                break;
            case 'POST':
                $params = json_encode($data);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            default:
                $params = json_encode($data);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }
        if (count($headers) > 0) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if ($this->isDebug) {
            curl_setopt($curl, CURLOPT_VERBOSE, true);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $httpStatusCode = intval(curl_getinfo($curl, CURLINFO_HTTP_CODE));
        $errNo = curl_errno($curl);
        $errMsg = curl_error($curl);
        curl_close($curl);
        if ($errNo > 0) {
            throw new RuntimeException($errMsg, $errNo);
        }
        if ($httpStatusCode > 399) {
            throw new RequestException($response, $httpStatusCode);
        }
        return $response;
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function get(string $url, array $params, array $headers = []): ?string
    {
        return $this->doRequest('GET', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function post(string $url, array $params, array $headers = []): ?string
    {
        return $this->doRequest('POST', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function put(string $url, array $params, array $headers = []): ?string
    {
        return $this->doRequest('PUT', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function delete(string $url, array $params, array $headers = []): ?string
    {
        return $this->doRequest('DELETE', $url, $params, $headers);
    }
}
