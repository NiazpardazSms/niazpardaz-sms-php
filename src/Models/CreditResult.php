<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه دریافت اعتبار
 */
class CreditResult
{
    /** @var float اعتبار باقیمانده */
    public float $credit;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->credit = (float)($data['credit'] ?? 0);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
