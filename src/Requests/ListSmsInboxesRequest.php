<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Requests;

use Dyrynda\Maxo\Data\Sms\Responses\ListInboxesResponse;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ListSmsInboxesRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/sms/list';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new ListInboxesResponse(
            status: $data['status'],
            count: $data['count'],
            inboxes: $data['smsinboxes'] ?: []
        );
    }
}
