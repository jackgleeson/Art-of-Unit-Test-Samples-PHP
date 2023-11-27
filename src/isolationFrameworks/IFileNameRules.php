<?php

namespace ArtOfUnitTesting\isolationFrameworks;

interface IFileNameRules
{

    public function isValidLogFileName(string $fileName) : bool;

}