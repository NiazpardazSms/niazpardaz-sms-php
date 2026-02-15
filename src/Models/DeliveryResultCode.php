<?php

namespace Niazpardaz\Sms\Models;

/**
 * کدهای نتیجه گزارش تحویل
 */
class DeliveryResultCode
{
    /** موفق */
    const Success = 0;

    /** خطا در ارتباط با سرویس دهنده */
    const ServiceConnectionError = -1;

    /** پیام با این کد وجود ندارد (batchSmsId نامعتبر است) */
    const InvalidBatchSmsId = -2;

    /** مهلت یک هفته ای گرفتن گزارش پایان یافته است */
    const ReportExpired = -3;

    /** پیام در صف ارسال مخابرات است، امکان گرفتن گزارش وجود ندارد */
    const MessageInQueue = -4;

    /** حداقل یک دقیقه بعد از ارسال اقدام نمایید */
    const TooEarly = -5;

    /** Ip موقتا بلاک شده است */
    const IpBlocked = -6;

    /** ApiKey نامعتبر */
    const InvalidApiKey = -7;
}
