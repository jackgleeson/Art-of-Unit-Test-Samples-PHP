<?php

namespace ArtOfUnitTesting;

class LogAnalyzerLocalFactoryExtractAndOverride
{


    public function isValidLogFileName(string $fileName) : bool
    {
        return $this->getExtensionManager()->isValid($fileName);
    }

    /**
     * This local factory method will be overridden in the test
     *
     * @return \ArtOfUnitTesting\IExtensionManager
     */
    protected function getExtensionManager() : IExtensionManager
    {
        return new FileExtensionManager();
    }

}

