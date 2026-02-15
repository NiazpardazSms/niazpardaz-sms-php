<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه بررسی شماره در لیست سیاه
 */
class IsBlacklistResult
{
    /** @var bool آیا شماره در لیست سیاه است؟ */
    public bool $isBlack;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->isBlack = (bool)($data['isBlack'] ?? false);
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
