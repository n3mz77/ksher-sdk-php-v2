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

    public function __construct($mid, $timestamp = null)
    {
        $this->timestamp = ($timestamp ?? time()) . '';
        $this->mid = $mid;
    }
}
