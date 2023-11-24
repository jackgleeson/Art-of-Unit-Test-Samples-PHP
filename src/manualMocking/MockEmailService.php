<?php

namespace ArtOfUnitTesting\manualMocking;

class MockEmailService implements IEmailService
{
    public string $to;
    public string $subject;
    public string $body;

    public function sendEmail(string $to, string $subject, string $body) : void
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }

}