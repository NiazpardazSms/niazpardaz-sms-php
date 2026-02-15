<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه ارسال پیامک نظیر به نظیر
 */
class SendLikeToLikeResult
{
    /** @var int شناسه پیامک */
    public int $smsId;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->smsId = (int)($data['smsId'] ?? 0);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
