<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\GravatarModule;

use Phimple\Container;
use Trident\Component\HttpKernel\Module\AbstractModule;

/**
 * SeerUK Gravatar Bundle
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class SeerUKGravatarModule extends AbstractModule
{
    /**
     * {@inheritDoc}
     */
    public function registerServices(Container $container)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function registerServiceExtensions(Container $container)
    {
        $extensions = require 'module/config/service_extensions.php';

        call_user_func($extensions, $container);
    }
}
