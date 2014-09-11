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
use SeerUK\Module\CacheModule\Registry\CacheRegistry;
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
    protected $cacheRegistry;
    protected $cachingProxy;
    protected $entityManager;


    /**
     * Get all articles
     *
     * @return Response
     */
    public function collectionAction()
    {
        return $this->cachingProxy->proxy('api.articles.collection',
            function() {
                $articles = $this->articleRepo->findAll();

                return $this->renderJson([
                    'count'    => count($articles),
                    'articles' => $articles,
                ]);
            }
        , 3600);
    }

    /**
     * Fetch a single article
     *
     * @param integer $id
     *
     * @return Response
     */
    public function getAction($id)
    {
        return $this->cachingProxy->proxy('api.articles.' . $id,
            function() use ($id) {
                return $this->renderJson($this->articleRepo->findOneById($id));
            }
        , 3600);
    }

    /**
     * Create a new article
     *
     * @return Response
     */
    public function postAction()
    {
        if ( ! $this->security->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }

        $response = $this->renderJson([]);
        $response->setStatusCode(201);

        return $response;
    }

    /**
     * Update a single article
     *
     * @param integer $id
     *
     * @return Response
     */
    public function patchAction($id)
    {
        if ( ! $this->security->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }

        return $this->renderJson([]);
    }

    /**
     * Delete a single repository
     *
     * @param integer $id
     *
     * @return Response
     */
    public function deleteAction($id)
    {
        if ( ! $this->security->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }

        $response = new Response();
        $response->setStatusCode(204);

        return $response;
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
     * Set cache registry
     *
     * @param CacheRegistry $cacheRegistry
     *
     * @return ArticlesController
     */
    public function setCacheRegistry(CacheRegistry $cacheRegistry)
    {
        $this->cacheRegistry = $cacheRegistry;

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

    /**
     * Set entity manager
     *
     * @param EntityManager $entityManager
     *
     * @return ArticlesController
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
