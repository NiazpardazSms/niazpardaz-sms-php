<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه ارسال پیامک گروهی
 */
class SendBatchSmsResult
{
    /** @var int شناسه یکتای ارسال گروهی */
    public int $batchSmsId;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->batchSmsId = (int)($data['batchSmsId'] ?? 0);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
