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

use Aegis\Token\StatelessTokenInterface;
use Aegis\Token\TokenInterface;
use Aegis\User\UserInterface;
use SeerUK\Module\SecurityModule\Data\Entity\User;

/**
 * Stateless User Token
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class StatelessUserToken extends UserToken implements StatelessTokenInterface
{
}
