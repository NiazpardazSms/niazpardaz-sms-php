<?php

namespace Niazpardaz\Sms;

use Niazpardaz\Sms\Exceptions\NiazpardazNetworkException;

/**
 * کلاینت HTTP داخلی بر پایه cURL
 *
 * این کلاس هیچ وابستگی خارجی ندارد و فقط از ext-curl استفاده می‌کند.
 * اگر Guzzle یا هر HTTP Client دیگری دارید، می‌توانید از آن استفاده کنید.
 *
 * @internal
 */
class HttpClient
{
    /** @var array<string, mixed> */
    private array $options;

    /**
     * @param array<string, mixed> $options تنظیمات cURL
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge([
            'timeout' => 30,
            'connect_timeout' => 10,
            'verify_ssl' => true,
        ], $options);
    }

    /**
     * ارسال درخواست POST با بدنه JSON
     *
     * @param string $url آدرس URL
     * @param array<string, string> $headers هدرهای HTTP
     * @param array<string, mixed> $payload بدنه درخواست
     * @return array{status_code: int, body: string}
     * @throws NiazpardazNetworkException
     */
    public function postJson(string $url, array $headers, array $payload): array
    {
        $ch = curl_init();

        if ($ch === false) {
            throw new NiazpardazNetworkException('خطا در ایجاد نشست cURL');
        }

        $curlHeaders = [];
        foreach ($headers as $key => $value) {
            $curlHeaders[] = "{$key}: {$value}";
        }

        $jsonBody = json_encode($payload);
        if ($jsonBody === false) {
            throw new NiazpardazNetworkException('خطا در تبدیل داده به JSON');
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $jsonBody,
            CURLOPT_HTTPHEADER => $curlHeaders,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->options['timeout'],
            CURLOPT_CONNECTTIMEOUT => $this->options['connect_timeout'],
            CURLOPT_SSL_VERIFYPEER => $this->options['verify_ssl'],
            CURLOPT_SSL_VERIFYHOST => $this->options['verify_ssl'] ? 2 : 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3,
        ]);

        $body = curl_exec($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $errno = curl_errno($ch);

        curl_close($ch);

        if ($body === false || $errno !== 0) {
            throw new NiazpardazNetworkException(
                "خطا در درخواست HTTP: {$error}",
                $errno
            );
        }

        return [
            'status_code' => $statusCode,
            'body' => (string) $body,
        ];
    }
}
