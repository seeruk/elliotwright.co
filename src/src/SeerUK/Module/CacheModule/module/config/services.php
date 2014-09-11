<?php

use SeerUK\Module\CacheModule\Registry\CacheRegistry;

return function($container) {
    // Services
    $container->set('cm.cache_registry', function($c) {
        return new CacheRegistry($c->get('caching'));
    });
};
