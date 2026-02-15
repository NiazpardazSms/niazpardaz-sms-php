<?php

namespace Niazpardaz\Sms\Models;

/**
 * کدهای نتیجه اعتبار
 */
class CreditResultCode
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
