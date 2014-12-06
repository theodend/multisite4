<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 06/12/2014
 * Time: 10:08
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
use ZPB\AdminBundle\Entity\FrontBox;

/**
 * Class LoadFrontBoxs
 * @package
 */
class LoadFrontBoxs40  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $fb1 = new FrontBox();
        $fb1->setTitle("Au programme")->setSubtitle("Calendrier des animations et spectacles")->setLink("/pratique/animations-spectacles")->setImage("/dev/assets/img/Carnet-Rose.jpg")->setSite("zoo")->setColor("lilas");
        $manager->persist($fb1);

        $fb2 = new FrontBox();
        $fb2->setTitle("Soigneur d'un jour")->setSubtitle("Vivez en une matinée une expérience de soigneur animalier")->setLink("/pratique/animations-spectacles")->setImage("/dev/assets/img/Soigneur-d-un-Jour.jpg")->setSite("zoo")->setColor("red");
        $manager->persist($fb2);

        $fb3 = new FrontBox();
        $fb3->setTitle("Parrainages")->setSubtitle("Devenez le Parrain d'un animal de Beauval")->setLink("/pratique/animations-spectacles")->setImage("/dev/assets/img/Ateliers-pedagogiques.jpg")->setSite("zoo")->setColor("green");
        $manager->persist($fb3);
        $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 40;
    }
}
