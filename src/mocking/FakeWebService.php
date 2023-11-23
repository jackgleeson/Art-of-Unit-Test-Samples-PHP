<?php

namespace ArtOfUnitTesting\mocking;

class FakeWebService implements IWebService
{
    public string $lastError;

    public function logError(string $message) : void
    {
        $this->lastError = $message;
    }
}