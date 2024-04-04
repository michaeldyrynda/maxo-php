<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Data\Sms;

final readonly class SendMessageData
{
    public function __construct(
        public string $origin,
        public string $destination,
        public string $message,
        public ?string $smsInbox = null,
    ) {
    }
}
