<?php

namespace Persec\KSherSdkV2\Entities;

class OrderCreateResponse
{
    public $acquirer;
    public $acquirer_order_id;
    public $amount;
    public $api_name;
    public $channel;
    public $channel_order_id;
    public $cleared;
    public $currency;
    public $error_code;
    public $error_message;
    public $force_clear;
    public $gateway_order_id;
    public $id;
    public $locked;
    public $merchant_order_id;
    public $mid;
    public $note;
    public $order_date;
    public $order_type;
    public $reference;
    public $reserved1;
    public $reserved2;
    public $signature;
    public $status;

    public function __construct(array $properties)
    {
        foreach ($properties as $k => $v) {
            if (property_exists($this, $k)) {
                $this->{$k} = $v;
            }
        }
    }
}
