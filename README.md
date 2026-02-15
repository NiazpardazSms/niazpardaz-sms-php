# Niazpardaz SMS SDK for PHP

Official PHP SDK for Niazpardaz SMS API | کتابخانه رسمی PHP برای API پیامکی نیازپرداز

[![Packagist](https://img.shields.io/packagist/v/niazpardazSms/sms.svg)](https://packagist.org/packages/niazpardazSms/sms)
[![PHP Version](https://img.shields.io/packagist/php-v/niazpardazsms/sms.svg)](https://packagist.org/packages/niazpardazSms/sms)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Tests](https://github.com/NiazpardazSms/niazpardaz-sms-php/actions/workflows/tests.yml/badge.svg)](https://github.com/NiazpardazSms/niazpardaz-sms-php/actions)

## Features | امکانات

- **Zero dependency** — Works with built-in cURL, no Guzzle required
- **بدون وابستگی خارجی** — فقط با ext-curl کار می‌کند
- **Laravel** — Auto-discovery, Facade, Config
- **Symfony** — Bundle, DI Extension
- **Framework-agnostic** — Works with any PHP framework (CodeIgniter, Yii, CakePHP, Slim, Laminas, ...)
- **PHP 7.4+** — Supports PHP 7.4, 8.0, 8.1, 8.2, 8.3, 8.4
- **Fully typed** — Type hints on all properties and methods

---

## نصب | Installation

```bash
composer require niazpardazsms/sms
```

---

## شروع سریع | Quick Start

```php
use Niazpardaz\Sms\NiazpardazSmsClient;
use Niazpardaz\Sms\Models\SendResultCode;

require 'vendor/autoload.php';

$client = new NiazpardazSmsClient("YOUR_API_KEY");

$result = $client->send(
    fromNumber: "10001234",
    toNumber: "09123456789",
    message: "سلام از نیازپرداز!"
);

if ($result->resultCode === SendResultCode::SendWasSuccessful) {
    echo "BatchSmsId: " . $result->batchSmsId;
}
```

---

## استفاده در فریم‌ورک‌ها | Framework Integration

### Laravel

پکیج به صورت خودکار شناسایی می‌شود (Auto-Discovery). فقط API Key رو در `.env` تنظیم کنید:

```env
NIAZPARDAZ_SMS_API_KEY=your-api-key-here
```

سپس فایل تنظیمات را منتشر کنید:

```bash
php artisan vendor:publish --tag=niazpardaz-sms-config
```

**استفاده با Facade:**

```php
use Niazpardaz\Sms\Laravel\Facades\NiazpardazSms;

$result = NiazpardazSms::send("10001234", "09123456789", "سلام!");
```

**استفاده با Dependency Injection:**

```php
use Niazpardaz\Sms\Contracts\NiazpardazSmsClientInterface;

class SmsController extends Controller
{
    public function send(NiazpardazSmsClientInterface $sms)
    {
        $result = $sms->send("10001234", "09123456789", "سلام!");
    }
}
```

### Symfony

در `config/bundles.php` اضافه کنید:

```php
return [
    // ...
    Niazpardaz\Sms\Symfony\NiazpardazSmsBundle::class => ['all' => true],
];
```

در `config/services.yaml` پارامترها رو تنظیم کنید:

```yaml
parameters:
    niazpardaz_sms.api_key: '%env(NIAZPARDAZ_SMS_API_KEY)%'
    niazpardaz_sms.timeout: 30
    niazpardaz_sms.connect_timeout: 10
    niazpardaz_sms.verify_ssl: true
```

```php
use Niazpardaz\Sms\NiazpardazSmsClient;

class SmsService
{
    public function __construct(private NiazpardazSmsClient $smsClient) {}

    public function notify(string $phone, string $message): void
    {
        $this->smsClient->send("10001234", $phone, $message);
    }
}
```

### CodeIgniter 4

در `app/Config/Services.php`:

```php
use Niazpardaz\Sms\NiazpardazSmsClient;

public static function sms(bool $getShared = true): NiazpardazSmsClient
{
    if ($getShared) return static::getSharedInstance('sms');
    return new NiazpardazSmsClient(env('NIAZPARDAZ_SMS_API_KEY'));
}
```

```php
$result = service('sms')->send("10001234", "09123456789", "سلام!");
```

### Yii2

در `config/web.php`:

```php
'components' => [
    'sms' => function () {
        return new \Niazpardaz\Sms\NiazpardazSmsClient(
            getenv('NIAZPARDAZ_SMS_API_KEY')
        );
    },
],
```

```php
$result = Yii::$app->sms->send("10001234", "09123456789", "سلام!");
```

### CakePHP 5

در `config/app.php`:

```php
'NiazpardazSms' => [
    'api_key' => env('NIAZPARDAZ_SMS_API_KEY'),
],
```

```php
use Niazpardaz\Sms\NiazpardazSmsClient;

$client = new NiazpardazSmsClient(Configure::read('NiazpardazSms.api_key'));
$result = $client->send("10001234", "09123456789", "سلام!");
```

### Slim / Laminas / هر فریم‌ورک دیگر

```php
use Niazpardaz\Sms\NiazpardazSmsClient;

$client = new NiazpardazSmsClient("YOUR_API_KEY");
$result = $client->send("10001234", "09123456789", "سلام!");
```

### Plain PHP (بدون فریم‌ورک)

```php
require 'vendor/autoload.php';

use Niazpardaz\Sms\NiazpardazSmsClient;

$client = new NiazpardazSmsClient("YOUR_API_KEY");
$result = $client->send("10001234", "09123456789", "سلام!");
```

---

## استفاده با Guzzle (اختیاری)

اگر از Guzzle استفاده می‌کنید:

```bash
composer require guzzlehttp/guzzle
```

```php
$guzzle = new \GuzzleHttp\Client(['timeout' => 60]);
$client = NiazpardazSmsClient::withGuzzle("YOUR_API_KEY", $guzzle);
```

---

## تمام متدها | API Reference

### ارسال پیامک تکی

```php
$result = $client->send("10001234", "09123456789", "متن پیامک");
echo $result->batchSmsId;
echo $result->resultCode;
```

### ارسال گروهی

```php
$result = $client->sendBulk("10001234", ["09123456789", "09198765432"], "پیام گروهی");
```

### ارسال نظیر به نظیر

```php
$result = $client->sendSmsLikeToLike(
    "10001234",
    ["09123456789", "09198765432"],
    ["سلام علی", "سلام رضا"]
);
echo $result->smsId;
```

### ارسال OTP صوتی

```php
$result = $client->sendVoiceOtp("10001234", "09123456789", "12345");
```

### گزارش تحویل

```php
use Niazpardaz\Sms\Models\DeliveryResultCode;

$delivery = $client->getBatchDelivery(123456);
if ($delivery->resultCode === DeliveryResultCode::Success) {
    foreach ($delivery->numbers as $i => $number) {
        echo "$number: " . $delivery->deliveryStatus[$i];
    }
}
```

### اعتبار

```php
use Niazpardaz\Sms\Models\CreditResultCode;

$credit = $client->getCredit();
if ($credit->resultCode === CreditResultCode::Success) {
    echo "اعتبار: " . $credit->credit;
}
```

### شماره‌های فرستنده

```php
$senders = $client->getSenderNumbers();
foreach ($senders->senders as $sender) {
    echo $sender;
}
```

### تعداد پیامک‌های دریافتی

```php
$inbox = $client->getInboxCount(isRead: false);
echo "تعداد: " . $inbox->inboxCount;
```

### لیست پیامک‌ها

```php
$messages = $client->getMessages(1, "10001234", 1, 50);
foreach ($messages->messages as $msg) {
    echo $msg->content;
}
```

### پیامک‌ها بر اساس بازه زمانی

```php
$messages = $client->getMessagesByDateRange(1, "10001234", "2023-01-01", "2023-01-31");
```

### لیست سیاه مخابرات

```php
$isBlack = $client->numberIsInTelecomBlacklist("09123456789");
echo $isBlack->isBlack ? "بله" : "خیر";

$blacklist = $client->extractTelecomBlacklistNumbers(["09123456789", "09198765432"]);
foreach ($blacklist->blackListNumbers as $number) {
    echo $number;
}
```

### بررسی محتوای پیامک

```php
$check = $client->checkSmsContent("متن تست");
echo $check->isValid ? "معتبر" : "نامعتبر";
```

---

## مدیریت خطا | Error Handling

```php
use Niazpardaz\Sms\Exceptions\NiazpardazApiException;
use Niazpardaz\Sms\Exceptions\NiazpardazNetworkException;
use Niazpardaz\Sms\Exceptions\NiazpardazValidationException;

try {
    $result = $client->send("10001234", "09123456789", "تست");
} catch (NiazpardazValidationException $e) {
    // خطای ورودی (مثل API Key خالی)
    echo "خطای اعتبارسنجی: " . $e->getMessage();
} catch (NiazpardazApiException $e) {
    // خطای منطقی API (مثل اعتبار ناکافی)
    echo "خطای API: " . $e->getMessage();
    echo "کد خطا: " . $e->getErrorCode();
} catch (NiazpardazNetworkException $e) {
    // خطای شبکه (مثل timeout)
    echo "خطای شبکه: " . $e->getMessage();
}
```

---

## تست | Testing

```bash
composer install
composer test
```

---

## نیازمندی‌ها | Requirements

- PHP 7.4 یا بالاتر
- اکستنشن `json`
- اکستنشن `curl`

---

## مجوز | License

MIT License — [LICENSE](LICENSE)

## پشتیبانی | Support

- مستندات: https://niazpardaz-sms.com/webservice
- گزارش باگ: [GitHub Issues](https://github.com/NiazpardazSms/niazpardaz-sms-php/issues)
