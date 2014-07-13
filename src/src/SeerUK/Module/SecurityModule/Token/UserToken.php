<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Token;

use Aegis\Token\TokenInterface;
use Aegis\User\UserInterface;
use SeerUK\Module\SecurityModule\Data\Entity\User;

/**
 * User Token
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserToken implements TokenInterface
{
    private $authenticated = false;
    private $credentials;
    private $user;

    /**
     * Constructor.
     *
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        if ($user = $this->getUser()) {
            return $user->getRoles();
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function flushCredentials()
    {
        unset($this->credentials);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isAuthenticated()
    {
        return (bool) $this->authenticated;
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthenticated($authenticated)
    {
        $this->authenticated = (bool) $authenticated;

        return $this;
    }
}
