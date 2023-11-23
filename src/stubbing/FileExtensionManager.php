<?php

namespace ArtOfUnitTesting\stubbing;

class FileExtensionManager implements IExtensionManager
{

    public function isValid(string $fileName) : bool
    {
        return pathinfo($fileName, PATHINFO_EXTENSION) === 'ext';
    }

}