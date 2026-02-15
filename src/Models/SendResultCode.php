<?php

namespace Niazpardaz\Sms\Models;

/**
 * کدهای نتیجه ارسال پیامک
 */
class SendResultCode
{
    /** ارسال با موفقیت انجام شد */
    const SendWasSuccessful = 0;

    /** نام کاربر یا کلمه عبور نامعتبر می باشد */
    const InvalidUserNameOrPassword = 1;

    /** کاربر مسدود شده است */
    const UserBlocked = 2;

    /** شماره فرستنده نامعتبر است */
    const InvalidSenderNumber = 3;

    /** محدودیت در ارسال روزانه */
    const LimitationInDailySend = 4;

    /** تعداد گیرندگان حداکثر 1000 شماره می باشد */
    const LimitationInRecieverCount = 5;

    /** خط فرستنده غیرفعال است */
    const SenderLineIsInactive = 6;

    /** متن پیامک شامل کلمات فیلتر شده است */
    const SmsContentFilteredWordsIsIncluded = 7;

    /** اعتبار کافی نیست */
    const NoCredit = 8;

    /** سامانه در حال بروز رسانی است */
    const SystemBeingUpdated = 9;

    /** وب سرویس غیرفعال است */
    const WebServiceNoActive = 10;

    /** پیاده سازی نشده است */
    const NotImplemented = 11;

    /** تعداد پیامها و شماره ها باید یکسان باشد */
    const LikeToLikeSendReceiverAndMessageCountShouldEqual = 12;

    /** تعداد پیامها حداکثر 100 پیام می باشد */
    const LimitationInMesssageContentCount = 13;

    /** هیچ مقداری برای تعرفه جاری کاربر تعریف نشده است */
    const UserTariffNotDetermined = 14;

    /** ارسال تکراری متن مشابه به شماره مشابه در مدت زمان مشخص */
    const DuplicateSendSms = 15;

    /** شماره موبایل گیرنده یافت نشد (گیرنده خالی، اشتباه یا بلاک لیست است) */
    const InvalidNumberEmptyOrBlackList = 16;

    /** متن وارد نشده است */
    const TextNotFound = 17;

    /** متن طبق الگوی تعریف شده نیست */
    const NotValidTemplateFound = 18;

    /** کاربر منقضی شده است */
    const UserExpired = 19;

    /** وضعیت کاربر فعال نیست */
    const UserIsNotActive = 20;

    /** مقدار یکی یا بیشتر از پارامترهای ورودی معتبر نیست */
    const InvalidParameters = 21;

    /** آی پی موقت بلاک شده است */
    const IpBlocked = 22;

    /** عملیات با خطا مواجه شد. لطفاً دقایقی دیگر مجدداً تلاش نمایید */
    const EnqueueFailed = 23;

    /** درخواست کاملا تکراری در بازه کوتاه (چند ثانیه) */
    const DuplicateRequestThreshold = 24;

    /** ApiKey نامعتبر */
    const InvalidApiKey = 25;

    /** خطا در ساخت فایل صوتی */
    const ErrorCreateVoiceFile = 26;
}
