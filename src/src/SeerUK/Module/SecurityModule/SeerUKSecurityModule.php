<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule;

use Phimple\Container;
use SeerUK\Module\SecurityModule\Console\Command\CreateUserCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Routing\RouteCollection;
use Trident\Component\HttpKernel\Module\AbstractModule;
use Trident\Component\HttpKernel\Module\ConsoleModuleInterface;

/**
 * SeerUK Security Bundle
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class SeerUKSecurityModule extends AbstractModule implements ConsoleModuleInterface
{
    public function registerCommands(Application $application)
    {
        $application->add(new CreateUserCommand());
    }

    /**
     * {@inheritDoc}
     */
    public function registerServices(Container $container)
    {
        $services = require 'module/config/services.php';

        call_user_func($services, $container);
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
