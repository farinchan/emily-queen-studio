<?php

namespace App\Exceptions;

use Exception;

class InstagramApiException extends Exception
{
    public function __construct(
        string $message = 'Instagram API Error',
        public int $status = 500,
        public ?int $errorCode = null,
        public ?int $errorSubcode = null,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $status, $previous);
    }

    public static function fromApiResponse(array $response, int $status = 400): self
    {
        $error = $response['error'] ?? [];
        $message = $error['message'] ?? 'An error occurred while communicating with Instagram API.';
        $code = $error['code'] ?? null;
        $subcode = $error['error_subcode'] ?? null;

        return new self($message, $status, $code, $subcode);
    }
}
