<?hh

return function($container) {
    // Extensions
    $container->extend('templating.engine.twig', function($twig, $c) {
        $environment = $twig->getEnvironment();
        $environment->addGlobal('config', $c->get('configuration'));

        return $twig;
    });
};