<?php

namespace Niazpardaz\Sms\Contracts;

use Niazpardaz\Sms\Models\BatchDeliveryResult;
use Niazpardaz\Sms\Models\BlacklistNumbersResult;
use Niazpardaz\Sms\Models\CheckContentResult;
use Niazpardaz\Sms\Models\CreditResult;
use Niazpardaz\Sms\Models\InboxCountResult;
use Niazpardaz\Sms\Models\IsBlacklistResult;
use Niazpardaz\Sms\Models\MessagesResult;
use Niazpardaz\Sms\Models\SendBatchSmsResult;
use Niazpardaz\Sms\Models\SenderNumbersResult;
use Niazpardaz\Sms\Models\SendLikeToLikeResult;

/**
 * اینترفیس کلاینت پیامکی نیازپرداز
 *
 * از این اینترفیس برای تزریق وابستگی (Dependency Injection)
 * و تست (Mocking) استفاده کنید.
 */
interface NiazpardazSmsClientInterface
{
    /**
     * ارسال پیامک تکی
     */
    public function send(
        string $fromNumber,
        string $toNumber,
        string $message,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult;

    /**
     * ارسال پیامک گروهی (یک متن به چند شماره)
     */
    public function sendBulk(
        string $fromNumber,
        array $toNumbers,
        string $message,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult;

    /**
     * ارسال پیامک نظیر به نظیر (متن‌های مختلف به شماره‌های مختلف)
     */
    public function sendSmsLikeToLike(
        string $fromNumber,
        array $toNumbers,
        array $messages,
        bool $isFlash = false
    ): SendLikeToLikeResult;

    /**
     * ارسال کد تایید صوتی (OTP)
     */
    public function sendVoiceOtp(
        string $fromNumber,
        string $toNumber,
        string $otp,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult;

    /**
     * دریافت گزارش تحویل بر اساس شناسه گروهی
     */
    public function getBatchDelivery(int $batchSmsId, int $pageIndex = 1, int $pageSize = 100): BatchDeliveryResult;

    /**
     * دریافت گزارش تحویل نظیر به نظیر بر اساس شناسه پیامک
     */
    public function getDeliveryLikeToLike(int $smsId): BatchDeliveryResult;

    /**
     * دریافت میزان اعتبار باقیمانده
     */
    public function getCredit(): CreditResult;

    /**
     * دریافت شماره‌های فرستنده فعال کاربر
     */
    public function getSenderNumbers(): SenderNumbersResult;

    /**
     * دریافت تعداد پیام‌های دریافتی
     */
    public function getInboxCount(bool $isRead = false): InboxCountResult;

    /**
     * دریافت لیست پیام‌ها
     */
    public function getMessages(
        int $messageType,
        string $fromNumbers,
        int $pageIndex = 1,
        int $pageSize = 100
    ): MessagesResult;

    /**
     * دریافت پیام‌ها در بازه زمانی مشخص
     */
    public function getMessagesByDateRange(
        int $messageType,
        string $fromNumbers,
        string $fromDate,
        string $toDate
    ): MessagesResult;

    /**
     * استخراج شماره‌های لیست سیاه مخابرات
     */
    public function extractTelecomBlacklistNumbers(array $numbers): BlacklistNumbersResult;

    /**
     * بررسی اینکه آیا شماره در لیست سیاه مخابرات هست؟
     */
    public function numberIsInTelecomBlacklist(string $number): IsBlacklistResult;

    /**
     * بررسی محتوای پیامک (فیلتر کلمات)
     */
    public function checkSmsContent(string $message): CheckContentResult;
}
