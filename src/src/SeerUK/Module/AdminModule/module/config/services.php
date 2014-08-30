<?php

use SeerUK\Module\AdminModule\Controller\Blog\ArticleController;

return function($container) {
    // Services
    $container->set('am.controller.article', function($c) {
        return new ArticleController($c->get('security'));
    });
};
