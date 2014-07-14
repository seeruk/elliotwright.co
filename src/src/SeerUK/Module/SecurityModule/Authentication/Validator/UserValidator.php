<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Authentication\Validator;

use SeerUK\Module\SecurityModule\Data\Entity\User;
use SeerUK\Module\SecurityModule\Encoder\UserPasswordEncoder;
use SeerUK\Module\SecurityModule\Token\UserToken;
use Trident\Component\Caching\Caching;

/**
 * User Validator
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserValidator
{
    private $caching;
    private $encoder;

    /**
     * Constructor.
     *
     * @param Caching $caching
     */
    public function __construct(Caching $caching, UserPasswordEncoder $encoder)
    {
        $this->caching = $caching;
        $this->encoder = $encoder;
    }

    /**
     * Validate a user
     *
     * @param UserToken $token
     * @param User      $user
     *
     * @return boolean
     */
    public function validate(UserToken $token, User $user)
    {
        if ($token->getCredentials()['username'] !== $user->getUsername()) {
            return false;
        }

        $hash = hash('sha256', json_encode([$user->getUsername(), $token->getCredentials()]));
        $key  = "sm.authenticator.user.validate.$hash";

        if ($this->caching->has($key)) {
            $result = $this->caching->get($key);
        } else {
            $result = $this->encoder->isValid($user->getPassword(), $token->getCredentials()['password']);

            $this->caching->set($key, $result);
        }

        return $result;
    }
}
