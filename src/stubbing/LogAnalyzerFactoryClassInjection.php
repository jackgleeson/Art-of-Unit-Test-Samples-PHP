<?php

namespace ArtOfUnitTesting\stubbing;

class LogAnalyzerFactoryClassInjection
{

    private IExtensionManager $manager;

    public function __construct()
    {
        $this->manager = ExtensionManagerFactory::create();
    }

    public function isValidLogFileName(string $fileName) : bool
    {
        return $this->manager->isValid($fileName);
    }

}

