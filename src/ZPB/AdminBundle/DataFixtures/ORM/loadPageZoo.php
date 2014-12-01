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

class loadPageZoo extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $page1->setName('zoo:homepage')->setSite('zoo')->setTitle('Accueil')->setRoute('zpb_sites_zoo_homepage')->setUrl($this->container->get('router')->generate('zpb_sites_zoo_homepage',[],false));
        $manager->persist($page1);
        $manager->flush();

        $page2 = new Page();
        $page2->setName('zoo:pratique:acces')->setSite('zoo')->setTitle('Accès')->setRoute('zpb_sites_zoo_utils_access')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_access',[],false));
        $manager->persist($page2);

        $page3 = new Page();
        $page3->setName('zoo:pratique:horaires')->setSite('zoo')->setTitle('Horaires et tarifs')->setRoute('zpb_sites_zoo_utils_schedules_prices')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_schedules_prices',[],false));
        $manager->persist($page3);

        $page4 = new Page();
        $page4->setName('zoo:pratique:animations')->setSite('zoo')->setTitle('Animations et spectacles')->setRoute('zpb_sites_zoo_utils_animations_shows')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_animations_shows',[],false));
        $manager->persist($page4);

        $page5 = new Page();
        $page5->setName('zoo:pratique:plan')->setSite('zoo')->setTitle('Plan de visite')->setRoute('zpb_sites_zoo_utils_map')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_map',[],false));
        $manager->persist($page5);

        $page6 = new Page();
        $page6->setName('zoo:pratique:restauration')->setSite('zoo')->setTitle('Restauration')->setRoute('zpb_sites_zoo_utils_restos')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_restos',[],false));
        $manager->persist($page6);

        $page7 = new Page();
        $page7->setName('zoo:pratique:services')->setSite('zoo')->setTitle('Services')->setRoute('zpb_sites_zoo_utils_services')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_services',[],false));
        $manager->persist($page7);

        $page8 = new Page();
        $page8->setName('zoo:zooparc:animaux')->setSite('zoo')->setTitle('Animaux')->setRoute('zpb_sites_zoo_zooparc_animals')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_zooparc_animals',[],false));
        $manager->persist($page8);

        $page9 = new Page();
        $page9->setName('zoo:zooparc:histoire')->setSite('zoo')->setTitle('Histoire')->setRoute('zpb_sites_zoo_zooparc_history')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_zooparc_history',[],false));
        $manager->persist($page9);

        $page10 = new Page();
        $page10->setName('zoo:zooparc:missions')->setSite('zoo')->setTitle('Missions')->setRoute('zpb_sites_zoo_zooparc_missions')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_zooparc_missions',[],false));
        $manager->persist($page10);

        $page11 = new Page();
        $page11->setName('zoo:zooparc:dev')->setSite('zoo')->setTitle('Developpement durable')->setRoute('zpb_sites_zoo_zooparc_concerns')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_zooparc_concerns',[],false));
        $manager->persist($page11);

        $page12 = new Page();
        $page12->setName('zoo:zooparc:galerie')->setSite('zoo')->setTitle('Galerie photos')->setRoute('zpb_sites_zoo_zooparc_gallery')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_zooparc_gallery',[],false));
        $manager->persist($page12);

        $page13 = new Page();
        $page13->setName('zoo:enfants:carnet')->setSite('zoo')->setTitle('Carnet de jeux')->setRoute('zpb_sites_zoo_children_game_pad')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_children_game_pad',[],false));
        $manager->persist($page13);

        $page14 = new Page();
        $page14->setName('zoo:enfants:soigneur')->setSite('zoo')->setTitle('Soigneurs juniors')->setRoute('zpb_sites_zoo_children_junior_keeper')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_children_junior_keeper',[],false));
        $manager->persist($page14);

        $page15 = new Page();
        $page15->setName('zoo:enfants:parcours')->setSite('zoo')->setTitle('Parcours enfants')->setRoute('zpb_sites_zoo_children_child_journey')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_children_child_journey',[],false));
        $manager->persist($page15);

        $page16 = new Page();
        $page16->setName('zoo:actualite:actualite')->setSite('zoo')->setTitle('Actualité')->setRoute('zpb_sites_zoo_news_news')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_news_news',[],false));
        $manager->persist($page16);

        $page17 = new Page();
        $page17->setName('zoo:actualite:nouveautes')->setSite('zoo')->setTitle('Nouveautés')->setRoute('zpb_sites_zoo_news_nouveautes')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_news_nouveautes',[],false));
        $manager->persist($page17);

        $page18 = new Page();
        $page18->setName('zoo:fans:fans')->setSite('zoo')->setTitle('Fans')->setRoute('zpb_sites_zoo_social')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_social',[],false));
        $manager->persist($page18);

        $page19 = new Page();
        $page19->setName('zoo:boutique:boutique')->setSite('zoo')->setTitle('Boutique')->setRoute('zpb_sites_zoo_shop')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_shop',[],false));
        $manager->persist($page19);

        $page20 = new Page();
        $page20->setName('zoo:contact:contact')->setSite('zoo')->setTitle('Contact')->setRoute('zpb_sites_zoo_contact')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_contact',[],false));
        $manager->persist($page20);

        $page21 = new Page();
        $page21->setName('zoo:faq:faq')->setSite('zoo')->setTitle('Questions fréquentes')->setRoute('zpb_sites_zoo_faq')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_faq',[],false));
        $manager->persist($page21);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
