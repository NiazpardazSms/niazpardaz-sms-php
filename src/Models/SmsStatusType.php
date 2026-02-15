<?php

namespace Niazpardaz\Sms\Models;

/**
 * وضعیت پیامک
 */
class SmsStatusType
{
    const None = -10;
    const Pending = 1;
    const Illegal = 2;
    const Sending = 3;
    const NotApproved = 4;
    const Sent = 5;
    const Canceled = 6;
    const Error = 7;
    const NoCredit = 8;
    const NotSent = 9;
    const WaitForSend = 10;
    const PendingDecCost = 11;
    const InQueue = 12;
    const ManyToManyCalcCost = 13;
}
