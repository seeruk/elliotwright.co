<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\ApiModule\Controller;

use Aegis\Aegis;
use Aegis\Authentication\Result;
use JMS\Serializer\Serializer;
use SeerUK\Module\SecurityModule\Token\StatelessUserToken;
use Symfony\Component\HttpFoundation\Response;
use Trident\Component\HttpFoundation\RequestStack;

/**
 * Abstract API Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class AbstractApiController
{
    protected $requestStack;
    protected $result;
    protected $security;
    protected $serializer;

    /**
     * Constructor
     *
     * @param Aegis $security
     */
    public function __construct(RequestStack $requestStack, Aegis $security, Serializer $serializer)
    {
        $this->requestStack = $requestStack;
        $this->security     = $security;
        $this->serializer   = $serializer;

        $this->authenticate();
    }

    /**
     * Attempt to authenticate the user
     *
     * @return Result|boolean
     */
    protected function authenticate()
    {
        $request = $this->requestStack->getCurrentRequest();

        $authorization = $request->headers->get('authorization');

        $credentials = null;
        if (0 === strpos(strtolower($authorization), 'basic')) {
            $encoded     = base64_decode(substr($authorization, 6));
            $exploded    = explode(':', $encoded);
            $credentials = [
                'username' => $exploded[0],
                'password' => $exploded[1],
            ];
        }

        if ($credentials) {
            return $this->result = $this->security->authenticate(new StatelessUserToken($credentials));
        }

        return false;
    }

    /**
     * Render JSON response
     *
     * @param  mixed $data
     *
     * @return Response
     */
    protected function renderJson($data)
    {
        $response = new Response();
        $response->headers->set('Content-type', 'application/json');
        $response->setContent($this->serializer->serialize($data, 'json'));

        return $response;
    }
}
