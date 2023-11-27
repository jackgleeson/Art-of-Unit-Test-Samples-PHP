<?php

namespace ArtOfUnitTesting\isolationFrameworks;


class LogAnalyzerWithMockAndStub
{

    private ILogger $logger;

    private IWebService $webService;

    private int $minNameLength = 8;

    public function __construct(ILogger $logger, IWebService $webService)
    {
        $this->logger = $logger;
        $this->webService = $webService;
    }

    public function analyze(string $filename) : void
    {
        if (strlen($filename) < $this->minNameLength) {
            try {
                $this->logger->logError("File name too short: " . $filename);
            } catch (\Exception $e) {
                $this->webService->write("Error from logger: " . $e->getMessage());
            }
        }
    }

    public function setMinNameLength(int $minNameLength) : void
    {
        $this->minNameLength = $minNameLength;
    }

    public function getLogger() : ILogger
    {
        return $this->logger;
    }

    public function setLogger(ILogger $logger) : void
    {
        $this->logger = $logger;
    }

    public function getWebService() : IWebService
    {
        return $this->webService;
    }

    public function setWebService(IWebService $webService) : void
    {
        $this->webService = $webService;
    }


}