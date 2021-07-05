<?php

namespace Persec\KSherSdkV2;

use Persec\KSherSdkV2\Exceptions\RequestException;
use Persec\KSherSdkV2\Exceptions\RuntimeException;

class Request
{
    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param array $headers
     * @return string|null
     * @throws RuntimeException
     * @throws RequestException
     */
    private function doRequest($method, $url, array $data = [], $headers = []): ?string
    {
        $curl = curl_init($url);
        $params = json_encode($data);
        switch (strtoupper($method)) {
            case 'GET':
                curl_setopt($curl, CURLOPT_POST, false);
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                break;
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        if (count($headers) > 0) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
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
     * @param $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function get(string $url, $params, array $headers = []): ?string
    {
        return $this->doRequest('GET', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function post(string $url, $params, array $headers = []): ?string
    {
        return $this->doRequest('POST', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function put(string $url, $params, array $headers = []): ?string
    {
        return $this->doRequest('PUT', $url, $params, $headers);
    }

    /**
     * @param string $url
     * @param $params
     * @param array $headers
     * @return string|null
     * @throws RequestException
     * @throws RuntimeException
     */
    public function delete(string $url, $params, array $headers = []): ?string
    {
        return $this->doRequest('DELETE', $url, $params, $headers);
    }
}
