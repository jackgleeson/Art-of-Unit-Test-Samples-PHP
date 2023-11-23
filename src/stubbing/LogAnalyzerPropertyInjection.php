<?php

namespace ArtOfUnitTesting\stubbing;

class LogAnalyzerPropertyInjection
{

    protected ?IExtensionManager $manager = null;

    public function isValidLogFileName(string $fileName) : bool
    {
        return $this->getManager()->isValid($fileName);
    }

    /**
     * @return \ArtOfUnitTesting\stubbing\IExtensionManager
     */
    protected function getManager() : IExtensionManager
    {
        if ($this->manager === null) {
            $this->manager = new FileExtensionManager();
        }

        return $this->manager;
    }

    /**
     * @param \ArtOfUnitTesting\stubbing\IExtensionManager $manager
     */
    public function setManager(IExtensionManager $manager) : void
    {
        $this->manager = $manager;
    }

}

