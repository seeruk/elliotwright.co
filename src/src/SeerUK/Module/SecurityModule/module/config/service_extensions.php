<?php

use SeerUK\Module\SecurityModule\Event\Listener\ForbiddenHttpExceptionListener;
use Trident\Component\HttpKernel\KernelEvents;

return function($container) {
    // Extensions
    $container->extend('security.aegis.authenticator.delegating', function($authenticator, $c) {
        $authenticator->addAuthenticator($c->get('sm.authenticator.user'));

        return $authenticator;
    });

    $container->extend('event_dispatcher', function($dispatcher, $c) {
        $dispatcher->addListener(KernelEvents::EXCEPTION, [
            new ForbiddenHttpExceptionListener(
                $c->get('configuration'),
                $c->get('request_stack'),
                $c->get('router'),
                $c->get('security')
            ),
            'onException'
        ]);

        return $dispatcher;
    });
};
