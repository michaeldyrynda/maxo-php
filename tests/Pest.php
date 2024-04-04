<?php

use Saloon\Http\Faking\MockClient;

uses()
    ->beforeEach(fn () => MockClient::destroyGlobal())
    ->in(__DIR__);
