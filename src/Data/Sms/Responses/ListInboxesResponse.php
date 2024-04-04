<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Data\Sms\Responses;

use Saloon\Traits\Responses\HasResponse;

final class ListInboxesResponse
{
    use HasResponse;

    public function __construct(
        public readonly int $status,
        public readonly int $count,
        /** @var array<array-key, int> */
        public readonly array $inboxes,
    ) {
    }
}
