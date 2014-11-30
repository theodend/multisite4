<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 14:49
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
use ZPB\AdminBundle\Entity\HeaderCarouselSlide;

/**
 * Class LoadHeaderCarouselSlides
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadHeaderCarouselSlides  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        // ##################################### zoo
        $slide1 = new HeaderCarouselSlide();
        $slide1->setSlider($this->getReference('zoo-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/zoo/headers/1417355266.jpg")
            ->setWebRoot("/img/sites/zoo/headers/1417355266.jpg");
        $manager->persist($slide1);

        $slide2 = new HeaderCarouselSlide();
        $slide2->setSlider($this->getReference('zoo-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/zoo/headers/1417355273.jpg")
            ->setWebRoot("/img/sites/zoo/headers/1417355273.jpg");
        $manager->persist($slide2);

        $slide3 = new HeaderCarouselSlide();
        $slide3->setSlider($this->getReference('zoo-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/zoo/headers/1417355280.jpg")
            ->setWebRoot("/img/sites/zoo/headers/1417355280.jpg");
        $manager->persist($slide3);

        $slide4 = new HeaderCarouselSlide();
        $slide4->setSlider($this->getReference('zoo-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/zoo/headers/1417355285.jpg")
            ->setWebRoot("/img/sites/zoo/headers/1417355285.jpg");
        $manager->persist($slide4);

        $slide5 = new HeaderCarouselSlide();
        $slide5->setSlider($this->getReference('zoo-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/zoo/headers/1417355291.jpg")
            ->setWebRoot("/img/sites/zoo/headers/1417355291.jpg");
        $manager->persist($slide5);

        // ############################################# bn
        $slide6 = new HeaderCarouselSlide();
        $slide6->setSlider($this->getReference('bn-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/bn/headers/1417363072.jpg")
            ->setWebRoot("/img/sites/bn/headers/1417363072.jpg");
        $manager->persist($slide6);

        $slide7 = new HeaderCarouselSlide();
        $slide7->setSlider($this->getReference('bn-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/bn/headers/1417363083.jpg")
            ->setWebRoot("/img/sites/bn/headers/1417363083.jpg");
        $manager->persist($slide7);

        $slide8 = new HeaderCarouselSlide();
        $slide8->setSlider($this->getReference('bn-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/bn/headers/1417363090.jpg")
            ->setWebRoot("/img/sites/bn/headers/1417363090.jpg");
        $manager->persist($slide8);

        $slide9 = new HeaderCarouselSlide();
        $slide9->setSlider($this->getReference('bn-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/bn/headers/1417363096.jpg")
            ->setWebRoot("/img/sites/bn/headers/1417363096.jpg");
        $manager->persist($slide9);

        $slide10 = new HeaderCarouselSlide();
        $slide10->setSlider($this->getReference('bn-carousel'))
            ->setIsActive(true)
            ->setRootDir("/var/www/vhosts/multisite4/app/../web/img/sites/bn/headers/1417363101.jpg")
            ->setWebRoot("/img/sites/bn/headers/1417363101.jpg");
        $manager->persist($slide10);



        $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 21;
    }
}
