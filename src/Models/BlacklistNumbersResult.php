<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه استخراج شماره‌های لیست سیاه
 */
class BlacklistNumbersResult
{
    /** @var string[] لیست شماره‌های لیست سیاه */
    public array $blackListNumbers;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->blackListNumbers = (array)($data['blackListNumbers'] ?? []);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
