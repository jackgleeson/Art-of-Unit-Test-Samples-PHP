<?php

namespace ArtOfUnitTesting\stubbing;

class LogAnalyzerExtractAndOverrideLocalFactory
{


    public function isValidLogFileName(string $fileName) : bool
    {
        return $this->getExtensionManager()->isValid($fileName);
    }

    /**
     * This local factory method will be overridden in the test
     *
     * @return \ArtOfUnitTesting\stubbing\IExtensionManager
     */
    protected function getExtensionManager() : IExtensionManager
    {
        return new FileExtensionManager();
    }

}

