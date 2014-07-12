<?php

use Symfony\Component\Routing\Route;

return function($collection) {
    $collection->add('bm_homepage', new Route('/', [
        '_controller' => 'SeerUK\Module\BlogModule\Controller\HomeController::indexAction'
    ]));
};
