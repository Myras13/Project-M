<?php

namespace App\Exceptions\HTTP;

use Symfony\Component\HttpKernel\Exception\HttpException as BaseHttpException;

class HttpException extends BaseHttpException
{
    protected string $errorCode;

    public function __construct(string $message = null, int $statusCode = null, array $headers = [])
    {
        $status = $statusCode ?? $this->getStatusCode();
        parent::__construct(statusCode: $status, message: $message, headers: $headers);
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}