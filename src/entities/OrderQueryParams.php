<?php

namespace Persec\KSherSdkV2\Entities;

class OrderQueryParams
{
    /**
     * @var string $timestamp
     */
    public $timestamp;

    public function __construct($timestamp)
    {
        $this->timestamp = $timestamp;
    }
}
