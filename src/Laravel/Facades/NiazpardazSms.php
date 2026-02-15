<?php

namespace Niazpardaz\Sms\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Niazpardaz\Sms\NiazpardazSmsClient;

/**
 * فاساد لاراول
 *
 * نمونه استفاده:
 * ```php
 * use Niazpardaz\Sms\Laravel\Facades\NiazpardazSms;
 *
 * $result = NiazpardazSms::send("10001234", "09123456789", "سلام!");
 * ```
 *
 * @method static \Niazpardaz\Sms\Models\SendBatchSmsResult send(string $fromNumber, string $toNumber, string $message, bool $isFlash = false, ?int $sendDelay = null)
 * @method static \Niazpardaz\Sms\Models\SendBatchSmsResult sendBulk(string $fromNumber, array $toNumbers, string $message, bool $isFlash = false, ?int $sendDelay = null)
 * @method static \Niazpardaz\Sms\Models\SendLikeToLikeResult sendSmsLikeToLike(string $fromNumber, array $toNumbers, array $messages, bool $isFlash = false)
 * @method static \Niazpardaz\Sms\Models\SendBatchSmsResult sendVoiceOtp(string $fromNumber, string $toNumber, string $otp, bool $isFlash = false, ?int $sendDelay = null)
 * @method static \Niazpardaz\Sms\Models\BatchDeliveryResult getBatchDelivery(int $batchSmsId, int $pageIndex = 1, int $pageSize = 100)
 * @method static \Niazpardaz\Sms\Models\BatchDeliveryResult getDeliveryLikeToLike(int $smsId)
 * @method static \Niazpardaz\Sms\Models\CreditResult getCredit()
 * @method static \Niazpardaz\Sms\Models\SenderNumbersResult getSenderNumbers()
 * @method static \Niazpardaz\Sms\Models\InboxCountResult getInboxCount(bool $isRead = false)
 * @method static \Niazpardaz\Sms\Models\MessagesResult getMessages(int $messageType, string $fromNumbers, int $pageIndex = 1, int $pageSize = 100)
 * @method static \Niazpardaz\Sms\Models\MessagesResult getMessagesByDateRange(int $messageType, string $fromNumbers, string $fromDate, string $toDate)
 * @method static \Niazpardaz\Sms\Models\BlacklistNumbersResult extractTelecomBlacklistNumbers(array $numbers)
 * @method static \Niazpardaz\Sms\Models\IsBlacklistResult numberIsInTelecomBlacklist(string $number)
 * @method static \Niazpardaz\Sms\Models\CheckContentResult checkSmsContent(string $message)
 *
 * @see \Niazpardaz\Sms\NiazpardazSmsClient
 */
class NiazpardazSms extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return NiazpardazSmsClient::class;
    }
}
