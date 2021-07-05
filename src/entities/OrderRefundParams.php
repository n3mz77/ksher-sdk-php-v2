<?php

namespace Persec\KSherSdkV2\Entities;

class OrderRefundParams
{
    /**
     * @var numeric $refund_amount
     */
    public $refund_amount;

    /**
     * @var string $timestamp
     */
    public $timestamp;

    /**
     * @var string $refund_order_id
     */
    public $refund_order_id;

    /**
     * @var string $mid
     */
    public $mid;

    /**
     * @var string $provider
     */
    public $provider;

    public function __construct($refund_amount, $timestamp, $refund_order_id, $mid, $provider)
    {
        $this->refund_amount = $refund_amount;
        $this->timestamp = $timestamp;
        $this->refund_order_id = $refund_order_id;
        $this->mid = $mid;
        $this->provider = $provider;
    }
}
