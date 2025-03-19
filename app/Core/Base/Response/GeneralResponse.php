<?php

namespace App\Core\Base\Response;

class GeneralResponse
{
    private int $statusCode;
    private mixed $data;
    private string $message;

    public function __construct(int $statusCode, mixed $data, string $message)
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->message = $message;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'statusCode' => $this->statusCode,
            'data' => $this->data,
            'message' => $this->message,
        ];
    }
}
