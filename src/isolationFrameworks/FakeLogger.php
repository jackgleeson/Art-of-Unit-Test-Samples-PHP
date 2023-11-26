<?php

namespace ArtOfUnitTesting\isolationFrameworks;


class FakeLogger implements ILogger
{
    public string $lastError;

    public function logError(string $message) : void
    {
        $this->lastError = $message;
    }
}