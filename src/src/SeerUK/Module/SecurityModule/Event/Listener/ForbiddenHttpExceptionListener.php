<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Event\Listener;

use Aegis\Aegis;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Trident\Component\Configuration\Configuration;
use Trident\Component\HttpFoundation\RequestStack;
use Trident\Component\HttpKernel\Event\FilterExceptionEvent;
use Trident\Component\HttpKernel\Exception\ForbiddenHttpException;

/**
 * ForbiddenHttpException Listener
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class ForbiddenHttpExceptionListener
{
    private $configuration;
    private $requestStack;
    private $router;
    private $security;

    /**
     * Contructor.
     *
     * @param Configuration $configuration
     * @param Router        $router
     * @param Aegis         $security
     */
    public function __construct(Configuration $configuration, RequestStack $requestStack, Router $router, Aegis $security)
    {
        $this->configuration = $configuration;
        $this->requestStack = $requestStack;
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * Handle an AccessDeniedException appropriately
     *
     * @param FilterExceptionEvent $event
     *
     * @return RedirectResponse|void
     */
    public function onException(FilterExceptionEvent $event)
    {
        if ( ! $event->isMasterRequest()
            || ! $event->getException() instanceof ForbiddenHttpException
            || $this->security->isAuthenticated()) {
            return;
        }

        // Attempt to get the login route, if one is set
        if ( ! $route = $this->configuration->get('security.login_route')) {
            return;
        }

        $options = [];
        if ($referer = $this->requestStack->getMasterRequest()->getUri()) {
            $options['referer'] = $referer;
        }

        // If we're dealing with an AccessDeniedException, and the user is not
        // logged in, then prompt them to do so. Otherwise, let the kernel
        // handle the exception to show the user an error page.
        $event->setResponse(new RedirectResponse($this->router->generate($route, $options, true)));
    }
}
