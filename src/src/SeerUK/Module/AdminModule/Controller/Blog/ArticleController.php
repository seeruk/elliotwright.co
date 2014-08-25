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
     * Edit a blog article
     *
     * @param integer $id
     *
     * @return Response
     */
    public function editAction($id)
    {
        if ( ! $this->get('security')->isGranted('ROLE_ADMIN')) {
            throw new ForbiddenHttpException('You are not granted access to this area.');
        }

        $ar = $this->get('bm.repository.article');
        $em = $this->get('doctrine.orm.entity_manager');
        $ff = $this->get('form.factory');

        $article = $ar->findOneById($id);

        if ( ! $article) {
            throw new NotFoundHttpException(sprintf(Article::ERR_NO_ARTICLE, $id));
        }

        $form = $ff->create(new ArticleType, $article);
        $form->handleRequest($this->get('request'));

        if ($form->isValid()) {
            $caching = $this->get('caching');
            $article = $form->getData();

            $em->persist($article);
            $em->flush();

            $caching->remove("rendered.blog.article.$id");

            // return $this->redirect($this->generateUrl('bm_blog_view', [
            //     'id' => $article->getId()
            // ]));
        }

        return $this->render('SeerUKAdminModule:Blog/Article:edit.html.twig', [
            'form'    => $form->createView(),
            'article' => $article
        ]);
    }
}
