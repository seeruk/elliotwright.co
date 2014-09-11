<?php

/*
 * This file is part of elliotwright.co
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\DoctrineModule\Data\Repository;

use InvalidArgumentException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Abstract Persistent Entity Repository
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
abstract class AbstractPersistentEntityRepository extends EntityRepository
{
    /**
     * Persist an entity in the persistent storage
     *
     * @param mixed $entity
     *
     * @return PersistentEntityRepository
     */
    public function persist($entity)
    {
        if (!$this->supports($entity)) {
            throw $this->createUnsupportedEntityEntityException($entity);
        }

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $this;
    }

    /**
     * Remove an entity from persistent storage
     *
     * @param mixed $entity
     *
     * @return PersistentEntityRepository
     */
    public function remove($entity)
    {
        if (!$this->supports($entity)) {
            throw $this->createUnsupportedEntityEntityException($entity);
        }

        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $this;
    }

    /**
     * Update an entity in the persistent storage. The entity must be being
     * managed by the entity manager for this method to work.
     *
     * @param mixed $entity
     *
     * @return PersistentEntityRepository
     */
    public function update($entity)
    {
        if (!$this->supports($entity)) {
            throw $this->createUnsupportedEntityEntityException($entity);
        }

        $this->getEntityManager()->flush();

        return $this;
    }

    /**
     * Create InvalidArgumentException decorated with unsupported entity
     * message w/ type
     *
     * @param mixed $entity
     *
     * @return InvalidArgumentException
     */
    protected function createUnsupportedEntityEntityException($entity)
    {
        return new InvalidArgumentException(sprintf(
            'Unsupported entity passed to repository, with type "%s"',
            is_object($entity)
                ? get_class($entity)
                : gettype($entity)
        ));
    }

    /**
     * Is the given entity supported?
     *
     * @param mixed $entity
     *
     * @return boolean
     */
    abstract public function supports($entity);
}
