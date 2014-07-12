<?hh

return function($container) {
    // Parameters
    $container['bm.templating.twig.loader.string.class'] = 'Twig_Loader_String';
    $container['bm.templating.engine.twig.string.class'] = 'Trident\\Component\\Templating\\Engine\\TwigEngine';

    // Services
    $container->set('bm.templating.twig.loader.string', function($c) {
        return new $c['bm.templating.twig.loader.string.class']();
    });

    $container->set('bm.templating.twig.environment.string', function($c) {
        $twig = clone $c->get('templating.engine.twig.environment');
        $twig->setLoader($c->get('bm.templating.twig.loader.string'));

        return $twig;
    });

    $container->set('bm.templating.engine.twig.string', function($c) {
        return new $c['bm.templating.engine.twig.string.class']($c->get('bm.templating.twig.environment.string'));
    });
};
