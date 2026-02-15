<?php

namespace Niazpardaz\Sms;

use Niazpardaz\Sms\Contracts\NiazpardazSmsClientInterface;
use Niazpardaz\Sms\Exceptions\NiazpardazApiException;
use Niazpardaz\Sms\Exceptions\NiazpardazNetworkException;
use Niazpardaz\Sms\Exceptions\NiazpardazValidationException;
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
 * کلاینت اصلی برای کار با API پیامکی نیازپرداز
 *
 * این کلاس بدون هیچ وابستگی خارجی کار می‌کند (فقط ext-curl لازم دارد).
 * در صورت تمایل می‌توانید Guzzle یا هر HTTP Client دیگری را تزریق کنید.
 *
 * نمونه استفاده ساده:
 * ```php
 * $client = new NiazpardazSmsClient("YOUR_API_KEY");
 * $result = $client->send("10001234", "09123456789", "سلام!");
 * ```
 *
 * نمونه استفاده با Guzzle:
 * ```php
 * $guzzle = new \GuzzleHttp\Client(['timeout' => 60]);
 * $client = NiazpardazSmsClient::withGuzzle("YOUR_API_KEY", $guzzle);
 * ```
 */
class NiazpardazSmsClient implements NiazpardazSmsClientInterface
{
    private string $apiKey;
    private string $baseUrl = "https://login.niazpardaz.ir/api/v2/RestWebApi";

    /**
     * کلاینت HTTP داخلی (cURL)
     * @var HttpClient|null
     */
    private ?HttpClient $httpClient = null;

    /**
     * کلاینت Guzzle (اختیاری)
     * @var object|null
     */
    private ?object $guzzleClient = null;

    /**
     * سازنده
     *
     * @param string $apiKey کلید API دریافتی از پنل نیازپرداز
     * @param array<string, mixed> $options تنظیمات HTTP (timeout, connect_timeout, verify_ssl)
     * @throws NiazpardazValidationException
     */
    public function __construct(string $apiKey, array $options = [])
    {
        $apiKey = trim($apiKey);

        if (empty($apiKey)) {
            throw new NiazpardazValidationException("کلید API نمی‌تواند خالی باشد");
        }

        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient($options);
    }

    /**
     * ساخت کلاینت با Guzzle HTTP Client
     *
     * @param string $apiKey کلید API
     * @param object $guzzleClient نمونه GuzzleHttp\Client
     * @return static
     * @throws NiazpardazValidationException
     */
    public static function withGuzzle(string $apiKey, object $guzzleClient): self
    {
        $instance = new self($apiKey);
        $instance->guzzleClient = $guzzleClient;
        $instance->httpClient = null;
        return $instance;
    }

    /**
     * تغییر آدرس پایه API (مفید برای تست)
     *
     * @param string $baseUrl آدرس جدید
     * @return $this
     */
    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        return $this;
    }

    // ─────────────────────────────────────────────────────────────
    //  متدهای ارسال پیامک
    // ─────────────────────────────────────────────────────────────

    /**
     * {@inheritdoc}
     */
    public function send(
        string $fromNumber,
        string $toNumber,
        string $message,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult {
        return $this->sendBulk($fromNumber, [$toNumber], $message, $isFlash, $sendDelay);
    }

    /**
     * {@inheritdoc}
     */
    public function sendBulk(
        string $fromNumber,
        array $toNumbers,
        string $message,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult {
        $payload = [
            'fromNumber' => $fromNumber,
            'messageContent' => $message,
            'toNumbers' => implode(",", $toNumbers),
            'isFlash' => $isFlash,
            'sendDelay' => $sendDelay,
        ];

        $result = $this->post("/SendBatchSms", $payload);
        return new SendBatchSmsResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function sendSmsLikeToLike(
        string $fromNumber,
        array $toNumbers,
        array $messages,
        bool $isFlash = false
    ): SendLikeToLikeResult {
        $payload = [
            'fromNumber' => $fromNumber,
            'messageContents' => implode(",", $messages),
            'toNumbers' => implode(",", $toNumbers),
            'isFlash' => $isFlash,
        ];

        $result = $this->post("/SendSmsLikeToLike", $payload);
        return new SendLikeToLikeResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function sendVoiceOtp(
        string $fromNumber,
        string $toNumber,
        string $otp,
        bool $isFlash = false,
        ?int $sendDelay = null
    ): SendBatchSmsResult {
        $payload = [
            'fromNumber' => $fromNumber,
            'messageContent' => $otp,
            'toNumbers' => $toNumber,
            'isFlash' => $isFlash,
            'sendDelay' => $sendDelay,
        ];

        $result = $this->post("/SendVoiceOtp", $payload);
        return new SendBatchSmsResult($result);
    }

    // ─────────────────────────────────────────────────────────────
    //  گزارش تحویل
    // ─────────────────────────────────────────────────────────────

    /**
     * {@inheritdoc}
     */
    public function getBatchDelivery(int $batchSmsId, int $pageIndex = 1, int $pageSize = 100): BatchDeliveryResult
    {
        $payload = [
            'batchSmsId' => $batchSmsId,
            'index' => $pageIndex,
            'count' => $pageSize,
        ];

        $result = $this->post("/GetBatchDelivery", $payload);
        return new BatchDeliveryResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getDeliveryLikeToLike(int $smsId): BatchDeliveryResult
    {
        $payload = ['smsId' => $smsId];

        $result = $this->post("/GetDeliveryLikeToLike", $payload);
        return new BatchDeliveryResult($result);
    }

    // ─────────────────────────────────────────────────────────────
    //  اعتبار و اطلاعات حساب
    // ─────────────────────────────────────────────────────────────

    /**
     * {@inheritdoc}
     */
    public function getCredit(): CreditResult
    {
        $result = $this->post("/GetCredit", []);
        return new CreditResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getSenderNumbers(): SenderNumbersResult
    {
        $result = $this->post("/GetSenderNumbers", []);
        return new SenderNumbersResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getInboxCount(bool $isRead = false): InboxCountResult
    {
        $payload = ['isRead' => $isRead];
        $result = $this->post("/GetInboxCount", $payload);
        return new InboxCountResult($result);
    }

    // ─────────────────────────────────────────────────────────────
    //  پیام‌ها
    // ─────────────────────────────────────────────────────────────

    /**
     * {@inheritdoc}
     */
    public function getMessages(
        int $messageType,
        string $fromNumbers,
        int $pageIndex = 1,
        int $pageSize = 100
    ): MessagesResult {
        $payload = [
            'messageType' => $messageType,
            'fromNumbers' => $fromNumbers,
            'index' => $pageIndex,
            'count' => $pageSize,
        ];

        $result = $this->post("/GetMessages", $payload);
        return new MessagesResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessagesByDateRange(
        int $messageType,
        string $fromNumbers,
        string $fromDate,
        string $toDate
    ): MessagesResult {
        $payload = [
            'messageType' => $messageType,
            'fromNumbers' => $fromNumbers,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];

        $result = $this->post("/GetMessagesByDateRange", $payload);
        return new MessagesResult($result);
    }

    // ─────────────────────────────────────────────────────────────
    //  لیست سیاه و بررسی محتوا
    // ─────────────────────────────────────────────────────────────

    /**
     * {@inheritdoc}
     */
    public function extractTelecomBlacklistNumbers(array $numbers): BlacklistNumbersResult
    {
        $payload = ['numbers' => implode(",", $numbers)];

        $result = $this->post("/ExtractTelecomBlacklistNumbers", $payload);
        return new BlacklistNumbersResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function numberIsInTelecomBlacklist(string $number): IsBlacklistResult
    {
        $payload = ['number' => $number];
        $result = $this->post("/NumberIsInTelecomBlacklist", $payload);
        return new IsBlacklistResult($result);
    }

    /**
     * {@inheritdoc}
     */
    public function checkSmsContent(string $message): CheckContentResult
    {
        $payload = ['message' => $message];
        $result = $this->post("/CheckSmsContent", $payload);
        return new CheckContentResult($result);
    }

    // ─────────────────────────────────────────────────────────────
    //  لایه HTTP (داخلی)
    // ─────────────────────────────────────────────────────────────

    /**
     * ارسال درخواست POST به API
     *
     * @param string $endpoint مسیر endpoint
     * @param array<string, mixed> $payload بدنه درخواست
     * @return array<string, mixed> نتیجه از API
     * @throws NiazpardazApiException
     * @throws NiazpardazNetworkException
     */
    private function post(string $endpoint, array $payload): array
    {
        $url = rtrim($this->baseUrl, '/') . $endpoint;

        $headers = [
            'X-API-Key'    => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        // اگر Guzzle تزریق شده، از آن استفاده کن
        if ($this->guzzleClient !== null) {
            return $this->postWithGuzzle($url, $headers, $payload);
        }

        // در غیر این صورت از HTTP Client داخلی (cURL) استفاده کن
        return $this->postWithCurl($url, $headers, $payload);
    }

    /**
     * ارسال با cURL داخلی
     */
    private function postWithCurl(string $url, array $headers, array $payload): array
    {
        $response = $this->httpClient->postJson($url, $headers, $payload);

        // اول status code رو چک کن
        if ($response['status_code'] !== 200) {
            throw new NiazpardazNetworkException(
                "خطا در ارتباط با سرور: HTTP {$response['status_code']}",
                $response['status_code']
            );
        }

        return $this->parseResponse($response['body']);
    }

    /**
     * ارسال با Guzzle
     */
    private function postWithGuzzle(string $url, array $headers, array $payload): array
    {
        try {
            $response = $this->guzzleClient->post($url, [
                'headers' => $headers,
                'json' => $payload,
            ]);

            // اول status code رو چک کن
            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new NiazpardazNetworkException(
                    "خطا در ارتباط با سرور: HTTP {$statusCode}",
                    $statusCode
                );
            }

            $body = $response->getBody()->getContents();
            return $this->parseResponse($body);

        } catch (NiazpardazNetworkException $e) {
            throw $e;
        } catch (NiazpardazApiException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw new NiazpardazNetworkException(
                "خطا در درخواست HTTP: " . $e->getMessage(),
                (int) $e->getCode(),
                $e
            );
        }
    }

    /**
     * تجزیه پاسخ JSON از API
     *
     * @param string $body بدنه پاسخ
     * @return array<string, mixed>
     * @throws NiazpardazApiException
     */
    private function parseResponse(string $body): array
    {
        $data = json_decode($body, true);

        if (!is_array($data)) {
            throw new NiazpardazApiException("پاسخ نامعتبر از سرور");
        }

        if (!($data['success'] ?? false)) {
            $errorMessage = $data['errorMessage'] ?? "خطای نامشخص";
            $errorCode = (int)($data['result']['resultCode'] ?? 0);
            throw new NiazpardazApiException($errorMessage, $errorCode);
        }

        return $data['result'] ?? [];
    }
}
