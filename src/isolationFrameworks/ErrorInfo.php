<?php

namespace ArtOfUnitTesting\isolationFrameworks;
class ErrorInfo
{
    private string $message;
    private int $severity;

    public function getSeverity() : int
    {
        return $this->severity;
    }

    public function setSeverity(int $severity) : void
    {
        $this->severity = $severity;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }


    public function __construct()
    {
    }

}