<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Requests;

use Dyrynda\Maxo\Data\Sms\Response\SendSmsResponse;
use Dyrynda\Maxo\Data\Sms\SendMessageData;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class SendSmsMessageRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected SendMessageData $data
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/sms/send';
    }

    protected function defaultQuery(): array
    {
        return array_filter([
            'origin' => $this->data->origin,
            'destination' => $this->data->destination,
            'message' => $this->data->message,
            'smsInbox' => $this->data->smsInbox,
        ], fn ($value) => ! is_null($value));
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $data = $response->json();

        return new SendSmsResponse(
            id: $data['smsid'],
            status: $data['status'],
            parts: $data['parts'],
            price: $data['price']
        );
    }
}
