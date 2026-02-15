<?php

namespace Niazpardaz\Sms\Models;

/**
 * اطلاعات پیامک
 */
class MessageInfo
{
    public int $messageId;
    public int $userId;
    public float $tariff;
    public string $content;
    public string $actionDateTime;
    public int $messageType;
    public string $sender;
    public string $receiver;
    public bool $flash;
    public int $pages;
    public int $lang;
    public int $status;
    public int $sendStatus;
    public int $sendMethod;
    public float $cost;
    public ?string $title;
    public int $count;
    public int $sent;
    public ?string $desc;
    public int $notSent;
    public bool $moneyIsRefunded;
    public bool $isRead;

    public function __construct(array $data)
    {
        $this->messageId = (int)($data['messageId'] ?? 0);
        $this->userId = (int)($data['userId'] ?? 0);
        $this->tariff = (float)($data['tariff'] ?? 0);
        $this->content = (string)($data['content'] ?? '');
        $this->actionDateTime = (string)($data['actionDateTime'] ?? '');
        $this->messageType = (int)($data['messageType'] ?? -10);
        $this->sender = (string)($data['sender'] ?? '');
        $this->receiver = (string)($data['receiver'] ?? '');
        $this->flash = (bool)($data['flash'] ?? false);
        $this->pages = (int)($data['pages'] ?? 0);
        $this->lang = (int)($data['lang'] ?? -10);
        $this->status = (int)($data['status'] ?? -10);
        $this->sendStatus = (int)($data['sendStatus'] ?? -10);
        $this->sendMethod = (int)($data['sendMethod'] ?? -10);
        $this->cost = (float)($data['cost'] ?? 0);
        $this->title = $data['title'] ?? null;
        $this->count = (int)($data['count'] ?? 0);
        $this->sent = (int)($data['sent'] ?? 0);
        $this->desc = $data['desc'] ?? null;
        $this->notSent = (int)($data['notSent'] ?? 0);
        $this->moneyIsRefunded = (bool)($data['moneyIsRefunded'] ?? false);
        $this->isRead = (bool)($data['isRead'] ?? false);
    }
}
