<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\SecurityModule\Controller;

use SeerUK\Module\SecurityModule\Form\Type\LoginType;
use SeerUK\Module\SecurityModule\Token\UserToken;
use Symfony\Component\HttpFoundation\Response;
use Trident\Module\FrameworkModule\Controller\Controller;

/**
 * Authentication Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class AuthenticationController extends Controller
{
    public function loginAction()
    {
        $ff = $this->get('form.factory');
        $ss = $this->get('security');

        $form = $ff->create(new LoginType(), []);
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $token = new UserToken($form->getData());

            $result = $ss->authenticate($token);

            // Do something with result (i.e. if status isn't 1)

            if ($result->getCode()) {
                return $this->redirect($this->generateUrl('bm_blog_view', [
                    'id' => 1
                ]));
            }
        }


        return $this->render('SeerUKSecurityModule:Authentication:login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
