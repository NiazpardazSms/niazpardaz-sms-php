<?php

namespace Niazpardaz\Sms\Symfony\DependencyInjection;

use Niazpardaz\Sms\Contracts\NiazpardazSmsClientInterface;
use Niazpardaz\Sms\NiazpardazSmsClient;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * اکستنشن DI سیمفونی
 */
class NiazpardazSmsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $definition = new Definition(NiazpardazSmsClient::class, [
            '%niazpardaz_sms.api_key%',
            [
                'timeout' => '%niazpardaz_sms.timeout%',
                'connect_timeout' => '%niazpardaz_sms.connect_timeout%',
                'verify_ssl' => '%niazpardaz_sms.verify_ssl%',
            ],
        ]);

        $definition->setPublic(true);

        $container->setDefinition(NiazpardazSmsClient::class, $definition);
        $container->setAlias(NiazpardazSmsClientInterface::class, NiazpardazSmsClient::class);

        // مقادیر پیش‌فرض
        if (!$container->hasParameter('niazpardaz_sms.api_key')) {
            $container->setParameter('niazpardaz_sms.api_key', '');
        }
        if (!$container->hasParameter('niazpardaz_sms.timeout')) {
            $container->setParameter('niazpardaz_sms.timeout', 30);
        }
        if (!$container->hasParameter('niazpardaz_sms.connect_timeout')) {
            $container->setParameter('niazpardaz_sms.connect_timeout', 10);
        }
        if (!$container->hasParameter('niazpardaz_sms.verify_ssl')) {
            $container->setParameter('niazpardaz_sms.verify_ssl', true);
        }
    }

    public function getAlias(): string
    {
        return 'niazpardaz_sms';
    }
}
