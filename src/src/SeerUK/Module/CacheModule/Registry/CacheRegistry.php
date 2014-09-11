<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\CacheModule\Registry;

use Trident\Component\Caching\Caching;

/**
 * An incredibly lazy class to easily manage caches
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class CacheRegistry
{
    /**
     * @var Caching
     */
    protected $caching;


    /**
     * Constructor.
     *
     * @param Caching $caching
     */
    public function __construct(Caching $caching)
    {
        $this->caching = $caching;
    }

    /**
     * Clear articles cache
     *
     * @return CacheRegistry
     */
    public function clearArticles()
    {
        $this->caching->remove('api.articles.collection');

        return $this;
    }

    /**
     * Clear articles by ID
     *
     * @param integer $id
     *
     * @return CacheRegistry
     */
    public function clearArticleById($id)
    {
        $this->caching->remove('api.articles.' . $id);

        return $this;
    }

    /**
     * Clear articles by slug
     *
     * @param string $slug
     *
     * @return CacheRegistry
     */
    public function clearArticleBySlug($slug)
    {
        $this->caching->remove('blog.articles.' . $slug);

        return $this;
    }
}
