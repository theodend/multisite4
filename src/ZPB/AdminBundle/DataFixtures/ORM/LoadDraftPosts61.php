<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 11:04
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

namespace ZPB\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\DraftPost;

/**
 * Class LoadDraftPosts
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadDraftPosts61  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $dr1 = new DraftPost();
        $dr1->setPost($this->getReference("post1"));
        $manager->persist($dr1);

        $dr2 = new DraftPost();
        $dr2->setPost($this->getReference("post2"));
        $manager->persist($dr2);

        $dr3 = new DraftPost();
        $dr3->setPost($this->getReference("post3"));
        $manager->persist($dr3);
        $manager->flush();

        $this->addReference('draft1', $dr1);
        $this->addReference('draft2', $dr2);
        $this->addReference('draft3', $dr3);
    }

    public function getOrder()
    {
        return 61;
    }
}
