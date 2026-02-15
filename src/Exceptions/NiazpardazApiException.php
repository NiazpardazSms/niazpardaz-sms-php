<?php

namespace Niazpardaz\Sms\Exceptions;

use Throwable;

/**
 * استثنای مربوط به خطاهای منطقی API نیازپرداز
 *
 * این استثنا زمانی پرتاب می‌شود که API پاسخ خطا برگرداند
 * (مثل اعتبار ناکافی، شماره نامعتبر، API Key اشتباه و...)
 */
class NiazpardazApiException extends NiazpardazException
{
    /** @var int کد خطای API */
    protected int $errorCode;

    /**
     * @param string $message پیام خطا
     * @param int $errorCode کد خطای API
     * @param Throwable|null $previous استثنای قبلی
     */
    public function __construct(string $message, int $errorCode = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $errorCode, $previous);
        $this->errorCode = $errorCode;
    }

    /**
     * دریافت کد خطای API
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
}
