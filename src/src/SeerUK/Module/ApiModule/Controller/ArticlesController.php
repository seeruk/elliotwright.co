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
use Doctrine\ORM\EntityRepository;
use SeerUK\Module\ApiModule\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Trident\Component\Caching\CachingProxy;
use Trident\Component\HttpKernel\Exception\ForbiddenHttpException;

/**
 * Articles Endpoint Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class ArticlesController extends AbstractApiController
{
    protected $articleRepo;
    protected $cachingProxy;

    /**
     * Get all articles
     *
     * @return JsonResponse
     */
    public function collectionAction()
    {
        return $this->cachingProxy->proxy('api.rendered.articles.collection',
            function() {
                return $this->renderJson([
                    'articles' => $this->articleRepo->findAll()
                ]);
            }
        , 3600);
    }

    public function getAction()
    {

    }

    public function postAction()
    {
        if ( ! $this->security->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }
    }

    public function deleteAction()
    {

    }

    /**
     * Set article repo
     *
     * @param EntityRepository $articleRepo
     *
     * @return ArticlesController
     */
    public function setArticleRepository(EntityRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;

        return $this;
    }

    /**
     * Set caching proxy
     *
     * @param CachingProxy $cachingProxy
     *
     * @return ArticlesController
     */
    public function setCachingProxy(CachingProxy $cachingProxy)
    {
        $this->cachingProxy = $cachingProxy;

        return $this;
    }
}
