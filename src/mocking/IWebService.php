<?php

namespace ArtOfUnitTesting\mocking;

interface IWebService
{
    public function logError(string $message) : void;

}