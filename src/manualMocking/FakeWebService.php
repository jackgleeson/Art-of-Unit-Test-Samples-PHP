<?php

namespace ArtOfUnitTesting\manualMocking;

use Exception;

class FakeWebService implements IWebService
{

    public ?Exception $toThrow = null;

    public function logError(string $message) : void {
        if ($this->toThrow) {
            throw $this->toThrow;
        }
    }
}