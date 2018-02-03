<?php

namespace AppBundle\EventListener;

use AppBundle\Api\ApiProblemException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $response = null;
        if ($exception instanceof ApiProblemException) {
            $apiProblem = $exception->getApiProblem();
            $response = new JsonResponse();
            $response->setStatusCode($exception->getStatusCode());
            $response->setContent($apiProblem->getMessage());
            $response->headers->set('Content-Type', 'application/problem+json');
        }
        $event->setResponse($response);
    }
}