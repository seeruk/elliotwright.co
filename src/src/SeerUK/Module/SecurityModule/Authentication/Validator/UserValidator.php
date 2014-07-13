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
use SeerUK\Module\SecurityModule\Token\UserToken;

/**
 * User Validator
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserValidator
{
    public function validate(UserToken $token, User $user)
    {
        $password = $token->getCredentials()['password'];

        return password_verify($password, $user->getPassword());
    }
}
