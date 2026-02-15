<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه بررسی محتوای پیامک
 */
class CheckContentResult
{
    /** @var bool آیا متن معتبر است؟ */
    public bool $isValid;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->isValid = (bool)($data['isValid'] ?? false);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
