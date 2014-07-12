<?hh

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule;

use Phimple\Container;
use Symfony\Component\Routing\RouteCollection;
use Trident\Component\HttpKernel\Module\AbstractModule;

/**
 * SeerUK Blog Bundle
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class SeerUKBlogModule extends AbstractModule
{
    /**
     * {@inheritDoc}
     */
    public function registerRoutes(RouteCollection $collection)
    {
        $routes = require 'module/config/routes.hh';

        call_user_func($routes, $collection);
    }

    /**
     * {@inheritDoc}
     */
    public function registerServices(Container $container)
    {
        $services = require 'module/config/services.hh';

        call_user_func($services, $container);
    }

    /**
     * {@inheritDoc}
     */
    public function registerServiceExtensions(Container $container)
    {
        $extensions = require 'module/config/service_extensions.hh';

        call_user_func($extensions, $container);
    }
}
