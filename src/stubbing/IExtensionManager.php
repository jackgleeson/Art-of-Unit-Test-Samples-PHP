<?php

namespace ArtOfUnitTesting\stubbing;

interface IExtensionManager
{

    public function isValid(string $fileName) : bool;

}