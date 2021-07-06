<?php

namespace Persec\KSherSdkV2\Entities;

class OrderCreateParams
{
    /**
     * @var numeric $amount
     */
    public $amount;

    /**
     * @var string $merchant_order_id
     */
    public $merchant_order_id;

    /**
     * @var string $note
     */
    public $note;

    /**
     * @var string $redirect_url
     */
    public $redirect_url;

    /**
     * @var string $redirect_url_fail
     */
    public $redirect_url_fail;

    /**
     * @var string $timestamp
     */
    public $timestamp;

    /**
     * @var string $channel
     */
    public $channel;
    //"channel": "alipay,wechat,linepay,airpay,promptpay,truemoney,ktbcard"

    /**
     * OrderCreateParams constructor.
     * @param $orderId
     * @param $amount
     * @param $successUrl
     * @param $failUrl
     * @param string $channel
     * @param string $note
     */
    public function __construct($orderId, $amount, $successUrl, $failUrl, $channel = '', $note = '')
    {
        $this->merchant_order_id = $orderId;
        $this->amount = $amount;
        $this->redirect_url = $successUrl;
        $this->redirect_url_fail = $failUrl;
        $this->note = $note;
        $this->timestamp = time() . '';
        $this->channel = $channel;
    }
}
