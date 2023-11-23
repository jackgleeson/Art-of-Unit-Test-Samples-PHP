<?php

namespace ArtOfUnitTesting\stubbing;

class LogAnalyzerConstructorInjection
{


    /**
     * @var \ArtOfUnitTesting\stubbing\IExtensionManager
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

