<?php

namespace Niazpardaz\Sms\Tests;

use PHPUnit\Framework\TestCase;
use Niazpardaz\Sms\NiazpardazSmsClient;
use Niazpardaz\Sms\Exceptions\NiazpardazValidationException;
use Niazpardaz\Sms\Exceptions\NiazpardazApiException;
use Niazpardaz\Sms\Models\SendResultCode;

class NiazpardazSmsClientTest extends TestCase
{
    public function testEmptyApiKeyThrowsValidationException(): void
    {
        $this->expectException(NiazpardazValidationException::class);
        new NiazpardazSmsClient('');
    }

    public function testWhitespaceApiKeyThrowsValidationException(): void
    {
        $this->expectException(NiazpardazValidationException::class);
        new NiazpardazSmsClient('   ');
    }

    public function testClientCanBeInstantiated(): void
    {
        $client = new NiazpardazSmsClient('test-api-key');
        $this->assertInstanceOf(NiazpardazSmsClient::class, $client);
    }

    public function testClientImplementsInterface(): void
    {
        $client = new NiazpardazSmsClient('test-api-key');
        $this->assertInstanceOf(
            \Niazpardaz\Sms\Contracts\NiazpardazSmsClientInterface::class,
            $client
        );
    }

    public function testSetBaseUrlReturnsSelf(): void
    {
        $client = new NiazpardazSmsClient('test-api-key');
        $result = $client->setBaseUrl('https://example.com/api');
        $this->assertSame($client, $result);
    }

    public function testSendResultCodeConstants(): void
    {
        $this->assertEquals(0, SendResultCode::SendWasSuccessful);
        $this->assertEquals(1, SendResultCode::InvalidUserNameOrPassword);
        $this->assertEquals(8, SendResultCode::NoCredit);
        $this->assertEquals(25, SendResultCode::InvalidApiKey);
    }
}
