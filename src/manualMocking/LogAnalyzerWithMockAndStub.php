<?php

namespace ArtOfUnitTesting\manualMocking;

class LogAnalyzerWithMockAndStub
{
    private IWebService $service;

    private IEmailService $emailService;

    public function __construct(IWebService $webService, IEmailService $emailService) {
        $this->service = $webService;
        $this->emailService = $emailService;
    }

    public function analyze(string $filename) : void
    {
        if(strlen($filename) < 8) {
             try {
                 $this->service->logError("File name too short: " . $filename);
             } catch (\Exception $e) {
                 $this->emailService->sendEmail("someone@somewhere.com", "Can't log!!!", $e->getMessage());
             }
        }
    }

    public function getService() : IWebService
    {
        return $this->service;
    }

    public function setService(IWebService $service) : void
    {
        $this->service = $service;
    }

    public function getEmailService() : IEmailService
    {
        return $this->emailService;
    }

    public function setEmailService(IEmailService $emailService) : void
    {
        $this->emailService = $emailService;
    }



}