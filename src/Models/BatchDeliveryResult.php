<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه گزارش تحویل
 */
class BatchDeliveryResult
{
    /** @var int کد نتیجه */
    public int $resultCode;

    /** @var string[] لیست شماره‌ها */
    public array $numbers;

    /** @var int[] وضعیت تحویل هر شماره */
    public array $deliveryStatus;

    public function __construct(array $data)
    {
        $this->resultCode = (int)($data['resultCode'] ?? -1);
        $this->numbers = (array)($data['numbers'] ?? []);
        $this->deliveryStatus = (array)($data['deliveryStatus'] ?? []);
    }
}
