<?php

return function($container) {
    // Parameters
    $container['templating.engine.twig.extension.gravatar.class'] = 'SeerUK\Module\GravatarModule\Twig\Extension\GravatarExtension';


    // Extensions
    $container->extend('templating.engine.twig.environment', function($environment, $c) {
        $environment->addExtension(new $c['templating.engine.twig.extension.gravatar.class']());

        return $environment;
    });
};
