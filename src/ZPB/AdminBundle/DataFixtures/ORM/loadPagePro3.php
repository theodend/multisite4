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

class loadPagePro3 extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $page1->setName('pro:homepage')->setSite('pro')->setTitle('Accueil')->setRoute('zpb_sites_pro_homepage')->setUrl($this->container->get('router')->generate('zpb_sites_pro_homepage',[],false));
        $manager->persist($page1);

        $page2 = new Page();
        $page2->setName('pro:contact')->setParent($page1)->setSite('pro')->setTitle('Contact')->setRoute('zpb_sites_pro_contact')->setUrl($this->container->get('router')->generate('zpb_sites_pro_contact',[],false));
        $manager->persist($page2);

        $page4 = new Page();
        $page4->setName('pro:legales:legales')->setParent($page1)->setSite('pro')->setTitle('Mentions légales')->setRoute('zpb_sites_pro_legales')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_pro_legales',[],false));
        $manager->persist($page4);

        $page5 = new Page();
        $page5->setName('pro:cgv:cgv')->setParent($page1)->setSite('pro')->setTitle('Conditions générales de vente')->setRoute('zpb_sites_pro_cgv')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_pro_cgv',[],false));
        $manager->persist($page5);

        $manager->flush();

        //autres

        //$manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
