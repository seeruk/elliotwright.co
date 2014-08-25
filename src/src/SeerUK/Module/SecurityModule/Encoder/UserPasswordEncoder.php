<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Encoder;

/**
 * User Password Encoder
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserPasswordEncoder
{
    /**
     * Encode the given password
     *
     * @param string $password
     * @param string $salt
     *
     * @return string
     */
    public function encode($password, $salt = null)
    {
        $options = [];
        $options['cost'] = 10;

        if (null !== $salt) {
            $options['salt'] = (string) $salt;
        }

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * Is password valid?
     *
     * @param string $encoded
     * @param string $password
     * @param mixed  $salt
     *
     * @return boolean
     */
    public function isValid($encoded, $password, $salt = null)
    {
        return password_verify($password, $encoded);
    }
}
