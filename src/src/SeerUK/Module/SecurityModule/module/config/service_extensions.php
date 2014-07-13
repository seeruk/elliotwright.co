<?php

return function($container) {
    // Extensions
    $container->extend('security.aegis.authenticator.delegating', function($authenticator, $c) {
        $authenticator->addAuthenticator($c->get('sm.authenticator.user'));

        return $authenticator;
    });
};
