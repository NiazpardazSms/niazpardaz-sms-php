<?php

namespace Niazpardaz\Sms\Models;

/**
 * وضعیت ارسال پیامک
 */
class SmsSendStatusType
{
    const None = -10;
    const Sent = 1;
    const Error = 2;
    const BlockList = 3;
}
