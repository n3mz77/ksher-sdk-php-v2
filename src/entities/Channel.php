<?php

namespace Persec\KSherSdkV2\Entities;

class Channel
{
    const Alipay = 'alipay';
    const Wechat = 'wechat';
    const LinePay = 'linepay';
    const AirPay = 'airpay';
    const PromptPay = 'promptpay';
    const TrueMoney = 'truemoney';
    const KtbCard = 'ktbcard';

    public static function getAll(): string
    {
        $allChannel = [self::Alipay, self::Wechat, self::LinePay, self::AirPay, self::PromptPay, self::TrueMoney, self::KtbCard];
        return implode(',', $allChannel);
    }
}
