<?php

use Aptoma\Twig\Extension\MarkdownEngine\MichelfMarkdownEngine;
use Aptoma\Twig\Extension\MarkdownExtension;
use SeerUK\Module\BlogModule\Data\Entity\Article;
use Trident\Component\Templating\Engine\TwigEngine;

return function($container) {
    // Services
    $container->set('bm.markdown.engine', function($c) {
        return new MichelfMarkdownEngine();
    });

    $container->set('bm.templating.twig.loader.string', function($c) {
        return new \Twig_Loader_String();
    });

    $container->set('bm.templating.twig.environment.string', function($c) {
        $twig = clone $c->get('templating.engine.twig.environment');
        $twig->setLoader($c->get('bm.templating.twig.loader.string'));

        return $twig;
    });

    $container->set('bm.templating.engine.twig.string', function($c) {
        return new TwigEngine($c->get('bm.templating.twig.environment.string'));
    });

    $container->set('bm.repository.article', function($c) {
        return $c->get('doctrine.orm.entity_manager')->getRepository(Article::class);
    });


    // Extensions
    $container->extend('templating.engine.twig.environment', function($environment, $c) {
        $environment->addExtension(new MarkdownExtension($c->get('bm.markdown.engine')));
        $environment->addGlobal('config', $c->get('configuration'));

        return $environment;
    });
};
