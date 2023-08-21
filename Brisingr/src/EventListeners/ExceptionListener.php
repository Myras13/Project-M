<?php

namespace App\EventListeners;

use App\Exceptions\HTTP\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        
        $response = new JsonResponse();

        if ($exception instanceof HttpException) {

            $response->setData([
                'message' => $exception->getMessage(),
                'code' => $exception->getErrorCode()
            ]);

            $response->setStatusCode($exception->getStatusCode());

        } else {

            $response->setData([
                'type' => 'exception',
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'description' => $exception->getMessage(),
                'violations' => $exception->getTrace(),
            ]);

            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}