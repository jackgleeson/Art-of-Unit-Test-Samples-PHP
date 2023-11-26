<?php

namespace ArtOfUnitTesting\isolationFrameworks;

class LogAnalyzerWithMock
{

    protected ILogger $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function analyze(string $tooShortFileName) : void
    {
        if (strlen($tooShortFileName) < 8) {
            $errorMessage = "File name too short: " . $tooShortFileName;
            $this->logger->logError($errorMessage);
        }
    }

}