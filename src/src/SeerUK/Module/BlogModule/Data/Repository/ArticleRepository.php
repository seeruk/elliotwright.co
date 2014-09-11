<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\BlogModule\Data\Repository;

use SeerUK\Module\BlogModule\Data\Entity\Article;
use SeerUK\Module\DoctrineModule\Data\Repository\AbstractPersistentEntityRepository;

/**
 * Article Repository
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class ArticleRepository extends AbstractPersistentEntityRepository
{
    /**
     * {@inheritDoc}
     */
    public function supports($entity)
    {
        return $entity instanceof Article;
    }
}
