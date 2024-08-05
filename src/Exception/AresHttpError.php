<?php

namespace App\Exception;

class AresHttpError extends \Error
{
    public function __construct(string $message, int $code, string $errorCode, string $errorSubCode)
    {
        parent::__construct($message, $code);
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getErrorSubCode(): string
    {
        return $this->errorSubCode;
    }
}
