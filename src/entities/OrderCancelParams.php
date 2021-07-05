<?php

namespace Persec\KSherSdkV2\Entities;

class OrderCancelParams
{
    /**
     * @var string $timestamp
     */
    public $timestamp;

    /**
     * @var string $mid;
     */
    public $mid;

    /**
     * @var string $provider
     */
    public $provider;


    public function __construct($timestamp, $mid, $provider)
    {
        $this->timestamp = $timestamp;
        $this->mid = $mid;
        $this->provider = $provider;
    }
}
