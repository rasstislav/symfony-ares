<?php

namespace App\Logger;

class Message implements \IteratorAggregate
{
    public function __construct(
        private string $message,
        private \Throwable $exception,
        private array $data = [],
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getException(): \Throwable
    {
        return $this->exception;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator([
            $this->getMessage(),
            [
                'exception' => $e = $this->getException(),
                'message' => $e->getMessage(),
                'data' => $this->getData(),
            ],
        ]);
    }
}
