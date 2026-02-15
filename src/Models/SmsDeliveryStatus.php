<?php

namespace Niazpardaz\Sms\Models;

/**
 * وضعیت تحویل پیامک
 */
class SmsDeliveryStatus
{
    /** نامشخص */
    const None = -10;

    /** ارسال شده به مخابرات */
    const SentToTelecom = 0;

    /** رسیده به گوشی */
    const Delivered = 1;

    /** نرسیده به گوشی */
    const NotDelivered = 2;

    /** خطای مخابراتی */
    const SmsFailed = 3;

    /** خطای نامشخص */
    const UnknownError = 4;

    /** رسیده به مخابرات */
    const ReceivedByTelecom = 5;

    /** نرسیده به مخابرات */
    const NotReceivedByTelecom = 6;

    /** مسدود شده توسط مقصد */
    const BlackListed = 7;

    /** نامشخص */
    const Unknown = 8;

    /** مخابرات پیام را مردود اعلام کرد */
    const RejectedByTelecom = 9;

    /** کنسل شده توسط اپراتور */
    const Canceled = 10;

    /** ارسال نشده */
    const NotSent = 11;

    /** تلگرام ندارد */
    const NoTelegram = 12;

    /** در صف ارسال */
    const InQueue = 13;
}
