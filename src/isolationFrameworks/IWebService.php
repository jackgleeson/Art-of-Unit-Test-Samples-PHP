<?php

namespace ArtOfUnitTesting\isolationFrameworks;

interface IWebService
{
    public function write(string $message) : void;

}