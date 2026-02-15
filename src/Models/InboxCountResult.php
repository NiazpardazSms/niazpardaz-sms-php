<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه دریافت تعداد پیامک‌های دریافتی
 */
class InboxCountResult
{
    /** @var int تعداد پیامک‌های دریافتی */
    public int $inboxCount;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->inboxCount = (int)($data['inboxCount'] ?? 0);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
