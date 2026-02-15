<?php

namespace Niazpardaz\Sms\Models;

/**
 * کدهای نتیجه استخراج شماره‌های لیست سیاه
 */
class BlacklistResultCode
{
    /** عملیات با موفقیت انجام شد */
    const Success = 0;

    /** نام کاربری و رمز عبور صحیح نمی باشد */
    const InvalidCredentials = -1;

    /** کاربر غیرفعال می باشد */
    const UserDisabled = -2;

    /** آرایه شماره های همراه خالی می باشد */
    const EmptyNumbersArray = -3;

    /** تعداد شماره ها حداکثر 1000 شماره می باشد */
    const MaxNumbersExceeded = -4;

    /** Ip موقتا بلاک شده است */
    const IpBlocked = -6;

    /** ApiKey نامعتبر */
    const InvalidApiKey = -7;
}
