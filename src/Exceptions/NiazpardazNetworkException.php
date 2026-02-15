<?php

namespace Niazpardaz\Sms\Exceptions;

use Throwable;

/**
 * استثنای مربوط به خطاهای شبکه و HTTP
 *
 * این استثنا زمانی پرتاب می‌شود که ارتباط با سرور برقرار نشود
 * (مثل timeout، DNS error، SSL error و...)
 */
class NiazpardazNetworkException extends NiazpardazException
{
    /**
     * @param string $message پیام خطا
     * @param int $code کد خطای HTTP یا cURL
     * @param Throwable|null $previous استثنای قبلی
     */
    public function __construct(string $message, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
