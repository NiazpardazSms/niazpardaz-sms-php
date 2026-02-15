<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه دریافت شماره‌های ارسال‌کننده
 */
class SenderNumbersResult
{
    /** @var string[] لیست شماره‌های فرستنده */
    public array $senders;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->senders = (array)($data['senders'] ?? []);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
