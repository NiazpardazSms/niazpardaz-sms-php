<?php

namespace Niazpardaz\Sms\Models;

/**
 * کدهای نتیجه شماره های ارسال کننده
 */
class SenderNumbersResultCode
{
    /** موفق */
    const Success = 0;

    /** نام کاربری و رمز عبور صحیح نمی باشد */
    const InvalidCredentials = -1;

    /** کاربر غیرفعال می باشد */
    const UserDisabled = -2;

    /** Ip موقتا بلاک شده است */
    const IpBlocked = -6;

    /** ApiKey نامعتبر */
    const InvalidApiKey = -7;
}
