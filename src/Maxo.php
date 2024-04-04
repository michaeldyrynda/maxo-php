<?php

declare(strict_types=1);

namespace Dyrynda\Maxo;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Maxo extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(
        protected string $key,
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://myapi.maxo.com.au';
    }

    public function sms(): Resources\Sms
    {
        return new Resources\Sms($this);
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultQuery(): array
    {
        return [
            'key' => $this->key,
        ];
    }
}
