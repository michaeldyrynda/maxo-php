# Maxo Telecommunications API SDK

> [!NOTE]
> This SDK is still a work in progress. Whilst functional for the [implemented resources](#resources), it is built against the Maxo [documentation](https://www.maxo.com.au/support/api-documentation) for optimistic scenarios.

[Maxo](https://maxo.com.au) is an Australian-based telephony services provider.

Use of this SDK requires an account with Maxo, as well as an API key.

My immediate use-case for this API was sending SMS, so those resources have been built first. 

The package leverages [Saloon](https://docs.saloon.dev) for it's HTTP layer.

<a name="resources"></a>
## Resources

| Resource | Status |
| -------- | ------ |
| SMS | Sending, inbox listing |
| Call History | Not implemented |
| Initiate Call | Not implemented |

<a name="installation"></a>
## Installation

```bash
composer require dyrynda/maxo-php
```

<a name="usage"></a>
## Usage

```php
use Dyrynda\Maxo\Maxo;
use Dyrynda\Maxo\Data\Sms\SendMessageData;

$maxo = new Maxo(
    key: 'your-maxo-key'
);

$response = $maxo->sms()->sendMessage(
    new SendMessageData(...)
);
```

