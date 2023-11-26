<?php

namespace ArtOfUnitTesting\isolationFrameworks;

interface ILogger
{
    public function logError(string $message) : void;

}