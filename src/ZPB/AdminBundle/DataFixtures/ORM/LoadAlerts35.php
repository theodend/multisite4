<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/12/2014
 * Time: 17:12
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
use ZPB\AdminBundle\Entity\Alert;

class LoadAlerts35 extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
    * @var \Symfony\Component\DependencyInjection\ContainerInterface
    */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $alert1 = new Alert();
        $now = new \DateTime();
        $nextWeek = (new \DateTime())->add(new \DateInterval("P7D"));
        $alert1->setType("warning")
            ->setTitle("Stop !")
            ->setBody("<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>")

            ->setStartAt($now)
            ->setEndAt($nextWeek)
            ->setTarget("zoo");

        $manager->persist($alert1);

        $manager->flush();
    }
    
    public function getOrder()
    {
        return 35;
    }
}
