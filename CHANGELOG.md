# Changelog

تمام تغییرات قابل توجه این پروژه در این فایل ثبت می‌شود.

## [2.0.0] - 2026-02-14

### تغییرات مهم (Breaking Changes)
- حذف وابستگی اجباری به Guzzle — پکیج حالا با cURL داخلی کار می‌کند
- تغییر constructor: پارامتر دوم از `?Client $httpClient` به `array $options` تغییر کرد
- برای استفاده از Guzzle، از `NiazpardazSmsClient::withGuzzle()` استفاده کنید

### اضافه شده
- HTTP Client داخلی بر پایه cURL (بدون وابستگی خارجی)
- پشتیبانی از Laravel (Service Provider + Facade + Config)
- پشتیبانی از Symfony (Bundle + DI Extension)
- Interface برای Dependency Injection و Mocking
- Exception های جداگانه (Api, Network, Validation)
- تست‌های PHPUnit
- GitHub Actions CI (PHP 7.4 تا 8.4)
- فایل CHANGELOG.md
- فایل .editorconfig
- فایل phpunit.xml

### رفع شده
- اصلاح Namespace در composer.json (مطابقت با فایل‌های PHP)
- اصلاح ترتیب بررسی status code در متد post()
- جداسازی کلاس‌ها به فایل‌های مجزا (PSR-4)
- حذف فیلد version از composer.json

## [1.0.0] - 2025-xx-xx

### اضافه شده
- انتشار اولیه
- ارسال پیامک تکی و گروهی
- ارسال نظیر به نظیر
- ارسال OTP صوتی
- گزارش تحویل
- مدیریت اعتبار
- مدیریت شماره‌های فرستنده
- صندوق ورودی
- لیست سیاه مخابرات
- بررسی محتوای پیامک
