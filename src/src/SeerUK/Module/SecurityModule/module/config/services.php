<?php

use SeerUK\Module\SecurityModule\Authentication\Authenticator\UserAuthenticator;
use SeerUK\Module\SecurityModule\Authentication\Validator\UserValidator;
use SeerUK\Module\SecurityModule\Data\Entity\User;
use SeerUK\Module\SecurityModule\Encoder\UserPasswordEncoder;

return function($container) {
    // Services
    $container->set('sm.authenticator.user', function($c) {
        $em = $c->get('doctrine.orm.entity_manager');

        return new UserAuthenticator(
            $c->get('caching'),
            $em->getRepository(User::class),
            $c->get('sm.user_validator')
        );
    });

    $container->set('sm.encoder.user', function($c) {
        return new UserPasswordEncoder();
    });

    $container->set('sm.user_validator', function($c) {
        return new UserValidator($c->get('caching'), $c->get('sm.encoder.user'));
    });
};
