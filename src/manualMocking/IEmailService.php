<?php

namespace ArtOfUnitTesting\manualMocking;

interface IEmailService
{

    public function sendEmail(string $to, string $subject, string $body) : void;

}