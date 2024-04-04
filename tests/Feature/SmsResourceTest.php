<?php

declare(strict_types=1);

use Dyrynda\Maxo\Data\Sms\Responses\SendSmsResponse;
use Dyrynda\Maxo\Data\Sms\Responses\ListInboxesResponse;
use Dyrynda\Maxo\Data\Sms\SendMessageData;
use Dyrynda\Maxo\Maxo;
use Dyrynda\Maxo\Requests\ListSmsInboxesRequest;
use Dyrynda\Maxo\Requests\SendSmsMessageRequest;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

describe('SMS Resource', function () {
    it('can send an sms message', function () {
        MockClient::global([
            SendSmsMessageRequest::class => MockResponse::fixture('sms/successful-send'),
        ]);

        $maxo = new Maxo('supersecret string key');

        $response = $maxo->sms()->sendMessage(new SendMessageData(
            origin: 'Testing',
            destination: '0400123456',
            message: 'This is a test message',
        ));

        expect($response)
            ->toBeInstanceOf(SendSmsResponse::class)
            ->id->toBe(3809490)
            ->status->toBe(1)
            ->parts->toBe(1)
            ->price->toBe(0.05);
    });

    it('handles unauthorised sending', function () {
        MockClient::global([
            SendSmsMessageRequest::class => MockResponse::fixture('sms/unauthorised-send'),
        ]);

        $maxo = new Maxo('supersecret string key');

        $maxo->sms()->sendMessage(new SendMessageData(
            origin: 'Testing',
            destination: '0400123456',
            message: 'This is a test message',
        ));
    })->expectException(RequestException::class);

    it('handles a bad request', function () {
        MockClient::global([
            SendSmsMessageRequest::class => MockResponse::fixture('sms/bad-request'),
        ]);

        $maxo = new Maxo('supersecret string key');

        $maxo->sms()->sendMessage(new SendMessageData(
            origin: 'Testing',
            destination: '0400123456',
            message: '',
        ));
    })->expectException(RequestException::class);

    it('can list sms inboxes', function () {
        MockClient::global([
            ListSmsInboxesRequest::class => MockResponse::fixture('sms/list-inboxes'),
        ]);

        $maxo = new Maxo('supersecret string key');

        $response = $maxo->sms()->listInboxes();

        expect($response)
            ->toBeInstanceOf(ListInboxesResponse::class)
            ->status->toBe(1)
            ->count->toBe(0)
            ->inboxes->toBeEmpty();
    });
});
