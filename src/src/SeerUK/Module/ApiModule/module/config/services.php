<?php

use SeerUK\Module\ApiModule\Controller\ArticlesController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

return function($container) {
    // Services
    $container->set('api.controller.articles', function($c) {
        $controller = new ArticlesController($c->get('request_stack'), $c->get('security'), $c->get('api.serializer'));
        $controller->setArticleRepository($c->get('bm.repository.article'));
        $controller->setCacheRegistry($c->get('cm.cache_registry'));
        $controller->setCachingProxy($c->get('caching.proxy'));

        return $controller;
    });

    $container->set('api.serializer', function($c) {
        return JMS\Serializer\SerializerBuilder::create()->build();
    });
};
