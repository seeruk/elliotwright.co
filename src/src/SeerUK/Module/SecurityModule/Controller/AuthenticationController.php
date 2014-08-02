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

use Aegis\Authentication\Result;
use SeerUK\Module\SecurityModule\Form\Type\LoginType;
use SeerUK\Module\SecurityModule\Token\UserToken;
use Symfony\Component\Form\FormError;
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
        $request = $this->get('request');

        if ($request->query->has('referer')) {
            $redirect = $request->query->get('referer');
        } else {
            $redirect = $this->generateUrl('bm_blog_view', [
                'id' => 1
            ]);
        }

        // If the user is already authenticated, send them to the referer
        if ($this->get('security')->isAuthenticated()) {
            return $this->redirect($redirect);
        }

        $ff = $this->get('form.factory');
        $ss = $this->get('security');

        $form = $ff->create(new LoginType(), []);
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $token = new UserToken($form->getData());

            $result = $ss->authenticate($token);

            if ($result->getCode() === Result::SUCCESS) {
                return $this->redirect($redirect);
            } else {
                $exception = $result->getException();

                $form->addError(new FormError($exception->getMessage()));
            }
        }


        return $this->render('SeerUKSecurityModule:Authentication:login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
