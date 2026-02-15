<?php

namespace Niazpardaz\Sms\Exceptions;

use Throwable;

/**
 * استثنای مربوط به خطاهای اعتبارسنجی ورودی
 *
 * این استثنا زمانی پرتاب می‌شود که پارامترهای ورودی نامعتبر باشند
 * (مثل API Key خالی، شماره نامعتبر و...)
 */
class NiazpardazValidationException extends NiazpardazException
{
    /**
     * @param string $message پیام خطا
     * @param int $code کد خطا
     * @param Throwable|null $previous استثنای قبلی
     */
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
