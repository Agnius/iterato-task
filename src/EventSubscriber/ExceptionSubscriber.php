<?php

namespace App\EventSubscriber;

use App\Exception\ValidationFailureException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(ExceptionEvent $event)
    {
        // TODO: Factory
        if ($event->getThrowable()->getCode() === ValidationFailureException::VALIDATION_FAILURE_CODE) {
            $response = new JsonResponse([
                'errors' => json_decode($event->getThrowable()->getMessage(), true)
            ]);
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}