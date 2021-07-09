<?php

namespace Persec\KSherSdkV2\Entities;

class OrderQueryResponse
{
    public $locked;
    public $merchant_order_id;
    public $channel_order_id;
    public $acquirer;
    public $reserved2;
    public $order_type;
    public $cleared;
    public $reference;
    public $channel;
    public $reserved1;
    public $reserved3;
    public $force_clear;
    public $gateway_order_id;
    public $reserved4;
    public $note;
    public $acquirer_order_id;
    public $id;
    public $error_message;
    public $timestamp;
    public $error_code;
    public $mid;
    public $signature;
    public $currency;
    public $order_date;
    public $api_name;
    public $status;
    public $amount;
    public function __construct(array $properties)
    {
        foreach ($properties as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }
}
