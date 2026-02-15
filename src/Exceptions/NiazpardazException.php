<?php

namespace Niazpardaz\Sms\Exceptions;

use Exception;
use Throwable;

/**
 * کلاس پایه استثناها
 */
abstract class NiazpardazException extends Exception
{
    /**
     * @param string $message پیام خطا
     * @param int $code کد خطا
     * @param Throwable|null $previous استثنای قبلی
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
