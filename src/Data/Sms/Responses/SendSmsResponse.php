<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Data\Sms\Responses;

use Saloon\Traits\Responses\HasResponse;

final class SendSmsResponse
{
    use HasResponse;

    public function __construct(
        public readonly int $id,
        public readonly int $status,
        public readonly int $parts,
        public readonly float $price,
    ) {
    }
}
