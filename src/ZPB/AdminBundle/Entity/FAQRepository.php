<?php

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FAQRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FAQRepository extends EntityRepository
{
    public function getAll()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("f","s")->from("ZPBAdminBundle:FAQ", "f");
        $qb->join("f.site","s");
        $qb->orderBy("s.name", "ASC");
        return $qb->getQuery()->getArrayResult();
    }

    public function getBySite($siteShortname)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("f","s")->from("ZPBAdminBundle:FAQ", "f");
        $qb->leftJoin("f.site","s");
        $qb->where("s.shortname = :name")->setParameter("name", $siteShortname);

        return $qb->getQuery()->getArrayResult();
    }
}
