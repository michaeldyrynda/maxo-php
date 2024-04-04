<?php

declare(strict_types=1);

namespace Dyrynda\Maxo\Resources;

use Dyrynda\Maxo\Data\Sms\Response\SendSmsResponse;
use Dyrynda\Maxo\Data\Sms\SendMessageData;
use Dyrynda\Maxo\Requests\SendSmsMessageRequest;
use Saloon\Http\BaseResource;

class Sms extends BaseResource
{
    public function sendMessage(SendMessageData $data): SendSmsResponse
    {
        return $this->connector->send(
            new SendSmsMessageRequest($data)
        )->dtoOrFail();
    }
}
