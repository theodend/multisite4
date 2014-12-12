<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/12/2014
 * Time: 11:32
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
use ZPB\AdminBundle\Entity\PublishPost;

/**
 * Class LoadPublishPosts62
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPublishPosts62  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $pu1 = new PublishPost();
        $pu1->setPost($this->getReference("post4"));
        $pu1->addSite($this->getReference('site-zoo'));
        $manager->persist($pu1);

        $pu2 = new PublishPost();
        $pu2->setPost($this->getReference("post5"));
        $pu2->addSite($this->getReference('site-zoo'));
        $manager->persist($pu2);

        $pu3 = new PublishPost();
        $pu3->setPost($this->getReference("post6"));
        $pu3->addSite($this->getReference('site-zoo'));
        $manager->persist($pu3);

        $pu4 = new PublishPost();
        $pu4->setPost($this->getReference("post7"));
        $pu4->addSite($this->getReference('site-bn'));
        $pu4->addSite($this->getReference('site-zoo'));
        $manager->persist($pu4);

        $manager->flush();

        //$this->addReference('', );
    }

    public function getOrder()
    {
        return 62;
    }
}
