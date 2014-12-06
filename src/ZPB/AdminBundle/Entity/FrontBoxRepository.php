<?php

namespace ZPB\AdminBundle\Entity;

use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * FrontBoxRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FrontBoxRepository extends SortableRepository
{
    public function findAllToArray($site = "")
    {
        if($site == ""){
            return [];
        }
        $qb = $this->createQueryBuilder("f")->where("f.site = :site")->orderBy("f.position","ASC");
        $qb->setParameter("site", $site);
        return $qb->getQuery()->getArrayResult();
    }
}
