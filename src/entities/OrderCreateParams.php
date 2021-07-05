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
     * @var string $provider
     */
    public $provider;

}
