<?php

namespace App\Exceptions\HTTP;

use Symfony\Component\HttpFoundation\Response;

class ConflictException extends HttpException
{
    public function __construct(string $message, array $headers = [])
    {
        parent::__construct($message, Response::HTTP_CONFLICT, $headers);
        $this->errorCode = 'conflict';
    }
}