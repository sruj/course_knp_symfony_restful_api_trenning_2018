<?php

namespace AppBundle\EventListener;

use AppBundle\Api\ApiProblemException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    private $debug;

    public function __construct($debug)
    {
        $this->debug = $debug;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        // allow 500 errors to be thrown
        if ($this->debug && $statusCode >= 500) {
            return;
        }

        if (!$exception instanceof ApiProblemException) {
            return;
        }

        if (strpos($event->getRequest()->getPathInfo(), '/api') !== 0) {
            return;
        }

        if ($exception instanceof ApiProblemException) {
            $response = null;
            $apiProblem = $exception->getApiProblem();
            $response = new JsonResponse();
            $response->setStatusCode($exception->getStatusCode());
            $response->setContent($apiProblem->getMessage());
            $response->headers->set('Content-Type', 'application/problem+json');
            $event->setResponse($response);
        }
    }
}