<?php

namespace ArtOfUnitTesting;

use Exception;

class LogAnalyzerSimulateException
{


    /**
     * @var \ArtOfUnitTesting\IExtensionManager
     */
    protected IExtensionManager $manager;

    public function __construct(IExtensionManager $mgr)
    {
        $this->manager = $mgr;
    }

    public function isValidLogFileName(string $fileName) : bool
    {
        try {
            return $this->manager->isValid($fileName);
        } catch (Exception $e) {
            // ugly! but this is what the book says to add
            return false;
        }
    }

}

