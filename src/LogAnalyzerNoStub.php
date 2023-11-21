<?php

namespace ArtOfUnitTesting;

class LogAnalyzerNoStub
{

    /**
     * Added for state-based testing
     * @var bool
     */
    public bool $wasLastFileNameValid;

    public function isValidLogFileName(string $fileName) : bool
    {
        $this->wasLastFileNameValid = false;
        if (empty($fileName)) {
            throw new \InvalidArgumentException("filename has to be provided");
        }

        $file_extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array($file_extension, ['log', 'LOG'])) {
            return false;
        }

        $this->wasLastFileNameValid = true;

        return true;
    }


}