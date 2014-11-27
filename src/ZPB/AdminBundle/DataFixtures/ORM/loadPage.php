<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 27/11/2014
 * Time: 17:08
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
use ZPB\AdminBundle\Entity\Page;

class loadPage extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $page1 = new Page();
        $page1->setName('homepage')->setTitle('Accueil')->setRoute('zpb_sites_zoo_homepage');
        $manager->persist($page1);
        $manager->flush();

        $page2 = new Page();
        $page2->setName('pratique:acces')->setTitle('Accès')->setRoute('zpb_sites_zoo_utils_access')->setParent($page1);
        $manager->persist($page2);

        $page3 = new Page();
        $page3->setName('pratique:horaires')->setTitle('Horaires et tarifs')->setRoute('zpb_sites_zoo_utils_schedules_prices')->setParent($page1);
        $manager->persist($page3);

        $page4 = new Page();
        $page4->setName('pratique:animations')->setTitle('Animations et spectacles')->setRoute('zpb_sites_zoo_utils_animations_shows')->setParent($page1);
        $manager->persist($page4);

        $page5 = new Page();
        $page5->setName('pratique:plan')->setTitle('Plan de visite')->setRoute('zpb_sites_zoo_utils_map')->setParent($page1);
        $manager->persist($page5);

        $page6 = new Page();
        $page6->setName('pratique:restauration')->setTitle('Restauration')->setRoute('zpb_sites_zoo_utils_restos')->setParent($page1);
        $manager->persist($page6);

        $page7 = new Page();
        $page7->setName('pratique:services')->setTitle('Services')->setRoute('zpb_sites_zoo_utils_services')->setParent($page1);
        $manager->persist($page7);

        $page8 = new Page();
        $page8->setName('zooparc:animaux')->setTitle('Animaux')->setRoute('zpb_sites_zoo_zooparc_animals')->setParent($page1);
        $manager->persist($page8);

        $page9 = new Page();
        $page9->setName('zooparc:histoire')->setTitle('Histoire')->setRoute('zpb_sites_zoo_zooparc_history')->setParent($page1);
        $manager->persist($page9);

        $page10 = new Page();
        $page10->setName('zooparc:missions')->setTitle('Missions')->setRoute('zpb_sites_zoo_zooparc_missions')->setParent($page1);
        $manager->persist($page10);

        $page11 = new Page();
        $page11->setName('zooparc:dev')->setTitle('Developpement durable')->setRoute('zpb_sites_zoo_zooparc_concerns')->setParent($page1);
        $manager->persist($page11);

        $page12 = new Page();
        $page12->setName('zooparc:galerie')->setTitle('Galerie photos')->setRoute('zpb_sites_zoo_zooparc_gallery')->setParent($page1);
        $manager->persist($page12);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
