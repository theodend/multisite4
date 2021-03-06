<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 14:50
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
use ZPB\AdminBundle\Entity\HeaderCarousel;

/**
 * Class LoaderCarouselHeaders
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoaderCarouselHeaders20  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $zooSlider = new HeaderCarousel();
        $zooSlider->setSite("zoo")->setDuration(7000);
        $manager->persist($zooSlider);

        $bnSlider = new HeaderCarousel();
        $bnSlider->setSite("bn")->setDuration(7000);
        $manager->persist($bnSlider);
        $manager->flush();


        $this->addReference('zoo-carousel', $zooSlider);
        $this->addReference('bn-carousel', $bnSlider);
    }

    public function getOrder()
    {
        return 20;
    }
}
