<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule\Controller;

use SeerUK\Module\BlogModule\Data\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Trident\Component\HttpKernel\Exception\NotFoundHttpException;
use Trident\Module\FrameworkModule\Controller\Controller;

/**
 * Article Controller
 *
 * Controls the homepage of the portfolio/blog
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class ArticleController extends Controller
{
    /**
     * View a blog article
     *
     * @param string $slug
     *
     * @return Response
     */
    public function viewAction($slug)
    {
        return $this->get('caching.proxy')->proxy("blog.articles.$slug",
            function() use ($slug) {
                $twig = $this->get('bm.templating.engine.twig.string');
                $ar   = $this->get('bm.repository.article');

                $article = $ar->findOneBySlug($slug);

                if ( ! $article) {
                    throw new NotFoundHttpException(sprintf(Article::ERR_NO_ARTICLE, $slug));
                }

                // Render the content and set it inside the article for view
                $article->setContent($twig->render('{% markdown %}'.$article->getContent().'{% endmarkdown %}'));

                return $this->render('SeerUKBlogModule:Blog:view.html.twig', [
                    'article' => $article
                ]);
            },
        3600);
    }
}
