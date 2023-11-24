<?php

namespace ArtOfUnitTesting\manualMocking;

class LogAnalyzerWithMock
{

    protected IWebService $service;

    public function __construct(IWebService $webService)
    {
        $this->service = $webService;
    }

    public function analyze(string $tooShortFileName) : void
    {
        if (strlen($tooShortFileName) < 8) {
            $errorMessage = "File name too short: " . $tooShortFileName;
            $this->service->logError($errorMessage);
        }
    }

}