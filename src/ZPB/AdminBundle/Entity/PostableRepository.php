<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 21:02
 */
 /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PostableRepository extends EntityRepository
{
    public function getPosts()
    {
        $qb = $this->createQueryBuilder("s")
            ->join("s.post", "p")->addSelect("p");

        return $qb->getQuery()->getArrayResult();
    }

    public function getPost($id)
    {
        $qb = $this->createQueryBuilder("s")
            ->join("s.post", "p")->addSelect("p")
        ;
        $qb->where($qb->expr()->eq("s.id", $id));
        return $qb->getQuery()->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
