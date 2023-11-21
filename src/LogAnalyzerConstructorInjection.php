<?php

namespace ArtOfUnitTesting;

class LogAnalyzerConstructorInjection
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
        return $this->manager->isValid($fileName);
    }

}

