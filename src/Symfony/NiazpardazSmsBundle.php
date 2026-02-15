<?php

namespace Niazpardaz\Sms\Symfony;

use Niazpardaz\Sms\Symfony\DependencyInjection\NiazpardazSmsExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * باندل سیمفونی
 *
 * در فایل config/bundles.php اضافه کنید:
 * Niazpardaz\Sms\Symfony\NiazpardazSmsBundle::class => ['all' => true],
 */
class NiazpardazSmsBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new NiazpardazSmsExtension();
    }
}
