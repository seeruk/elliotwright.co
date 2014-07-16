<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\AdminModule\Controller;

use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

/**
 * Admin Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('SeerUKAdminModule:Admin:index.html.twig', []);
    }
}
