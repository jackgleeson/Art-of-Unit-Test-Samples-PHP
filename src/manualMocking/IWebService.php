<?php

namespace ArtOfUnitTesting\manualMocking;

interface IWebService
{
    public function logError(string $message) : void;

}