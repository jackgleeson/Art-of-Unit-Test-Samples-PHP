<?php

namespace ArtOfUnitTesting\manualMocking;

class MockWebService implements IWebService
{
    public string $lastError;

    public function logError(string $message) : void
    {
        $this->lastError = $message;
    }
}