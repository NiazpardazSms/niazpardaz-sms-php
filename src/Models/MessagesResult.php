<?php

namespace Niazpardaz\Sms\Models;

/**
 * نتیجه دریافت پیامک‌ها
 */
class MessagesResult
{
    /** @var MessageInfo[] لیست پیامک‌ها */
    public array $messages;

    /** @var int کد نتیجه */
    public int $resultCode;

    public function __construct(array $data)
    {
        $this->messages = [];
        if (isset($data['messages']) && is_array($data['messages'])) {
            foreach ($data['messages'] as $msg) {
                $this->messages[] = new MessageInfo($msg);
            }
        }
        $this->resultCode = (int)($data['resultCode'] ?? -1);
    }
}
