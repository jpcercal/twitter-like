<?php

namespace Cekurte\TwitterLike\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * PostRepository
 */
class PostRepository extends EntityRepository
{
    /**
     * @return QueryBuilder
     */
    public function findResources()
    {
        $queryBuilder = $this->createQueryBuilder('p');

        return $queryBuilder
            ->addOrderBy('p.createdAt', 'DESC')
        ;
    }
}
