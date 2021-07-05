<?php
namespace Persec\KSherSdkV2;

class BaseSDK {
    /**
     * @var string $token
     */
    protected $token;

    /**
     * @var bool $debug
     */
    protected $debug = false;

    private $KEY_SIGNATURE = 'signature';

    public function __construct(string $token, $debug = false)
    {
        $this->token = $token;
        $this->debug = $debug;
    }

    /**
     * @param string $apiUrl
     * @param array$data
     * @return string|null
     */
    public function getSignature(string $apiUrl, array $data) : ?string
    {
        $keys = array_keys($data);
        sort($keys);
        $bucket = [];
        foreach ($keys as $key) {
           if ($key !== $this->KEY_SIGNATURE) {
              $bucket[] = $key;
              $bucket[] = $data;
           }
        }
        $bucketStr = implode('', $bucket);
        $paramsStr = $apiUrl . $bucketStr;
        $hash = hash_hmac('sha256', $paramsStr, $this->token, false);
        if (empty($hash)) {
            return null;
        }
        return strtoupper($hash);
    }

    /**
     * @param string $apiUrl
     * @param array $data
     * @return bool
     */
    public function checkSignature(string $apiUrl, array $data) : bool
    {
        $signature = $data[$this->KEY_SIGNATURE] ?? null;
        if (empty($signature)) {
            return false;
        }
        $sign = $this->getSignature($apiUrl, $data);
        if (empty($sign)) {
            return false;
        }
        return $signature === $sign;
    }
}
