<?php

namespace ArtOfUnitTesting;

interface IExtensionManager
{

    public function isValid(string $fileName) : bool;

}