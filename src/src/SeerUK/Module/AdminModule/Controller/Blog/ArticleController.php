<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\AdminModule\Controller\Blog;

use Aegis\Aegis;
use SeerUK\Module\BlogModule\Data\Entity\Article;
use SeerUK\Module\BlogModule\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Response;
use Trident\Component\HttpKernel\Exception\ForbiddenHttpException;
use Trident\Component\HttpKernel\Exception\NotFoundHttpException;
use Trident\Module\FrameworkModule\Controller\Controller;

/**
 * Article Admin Controller
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class ArticleController extends Controller
{
    /**
     * @var Aegis
     */
    protected $security;

    /**
     * Constructor.
     *
     * @param Aegis $security
     */
    public function __construct(Aegis $security)
    {
        $this->security = $security;

        if ( ! $this->security->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }
    }

    /**
     * Blog articles overview
     *
     * @return Response
     */
    public function overviewAction()
    {
        $ar = $this->get('bm.repository.article');

        $articles = $ar->findAll();

        return $this->render('SeerUKAdminModule:Blog/Article:overview.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Edit a blog article
     *
     * @param integer $id
     *
     * @return Response
     */
    public function editAction($slug)
    {
        $ar = $this->get('bm.repository.article');
        $em = $this->get('doctrine.orm.entity_manager');
        $ff = $this->get('form.factory');

        $article = $ar->findOneBySlug($slug);

        if ( ! $article) {
            throw new NotFoundHttpException(sprintf(Article::ERR_NO_ARTICLE, $slug));
        }

        $form = $ff->create(new ArticleType, $article);
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $caching = $this->get('caching');
            $article = $form->getData();

            $em->persist($article);
            $em->flush();

            $caching->remove("rendered.blog.article.$slug");

            // return $this->redirect($this->generateUrl('bm_blog_view', [
            //     'slug' => $article->getSlug()
            // ]));
        }

        return $this->render('SeerUKAdminModule:Blog/Article:edit.html.twig', [
            'form'    => $form->createView(),
            'article' => $article
        ]);
    }
}
