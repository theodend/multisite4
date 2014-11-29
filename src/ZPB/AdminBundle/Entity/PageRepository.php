<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends NestedTreeRepository
{
    public function hasPageNamed($name)
    {
        $qb = $this->createQueryBuilder("p");
        $qb->select("COUNT(p)")->where($qb->expr()->eq("p.name",":name"))->setParameter("name", $name);
        return $qb->getQuery()->getSingleScalarResult();
    }
}
