<?php

namespace ArtOfUnitTesting;

class LogAnalyzerExtractAndOverrideDirectResult
{


    public function isValidLogFileName(string $fileName) : bool
    {
        return $this->isValid($fileName);
    }

    /**
     * This method will be overridden in the test
     * @param string $fileName
     *
     * @return bool
     */
    protected function isValid( string $fileName) : bool
    {
        return (new FileExtensionManager())->isValid($fileName);
    }
}

