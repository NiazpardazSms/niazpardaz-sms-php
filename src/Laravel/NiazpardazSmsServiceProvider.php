<?php

namespace Niazpardaz\Sms\Laravel;

use Illuminate\Support\ServiceProvider;
use Niazpardaz\Sms\Contracts\NiazpardazSmsClientInterface;
use Niazpardaz\Sms\NiazpardazSmsClient;

/**
 * سرویس پروایدر لاراول
 *
 * این سرویس پروایدر به صورت خودکار توسط Laravel Package Discovery شناسایی می‌شود.
 *
 * تنظیمات را با دستور زیر منتشر کنید:
 * php artisan vendor:publish --tag=niazpardaz-sms-config
 */
class NiazpardazSmsServiceProvider extends ServiceProvider
{
    /**
     * ثبت سرویس‌ها
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/niazpardaz-sms.php',
            'niazpardaz-sms'
        );

        $this->app->singleton(NiazpardazSmsClient::class, function ($app) {
            /** @var array<string, mixed> $config */
            $config = $app['config']->get('niazpardaz-sms', []);

            return new NiazpardazSmsClient(
                $config['api_key'] ?? '',
                [
                    'timeout' => $config['timeout'] ?? 30,
                    'connect_timeout' => $config['connect_timeout'] ?? 10,
                    'verify_ssl' => $config['verify_ssl'] ?? true,
                ]
            );
        });

        // Bind interface to implementation
        $this->app->alias(NiazpardazSmsClient::class, NiazpardazSmsClientInterface::class);
    }

    /**
     * بوت سرویس‌ها
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/niazpardaz-sms.php' => $this->app->configPath('niazpardaz-sms.php'),
        ], 'niazpardaz-sms-config');
    }
}
