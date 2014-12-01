<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/11/2014
 * Time: 15:57
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

/**
 * Class LoadPageBn
 * @package ZPB\AdminBundle\DataFixtures\ORM
 */
class LoadPageBn2  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $page1 = new Page();
        $page1->setName('bn:homepage')->setSite('bn')->setTitle('Accueil')->setRoute('zpb_sites_bn_homepage')->setUrl($this->container->get('router')->generate('zpb_sites_bn_homepage',[],false));
        $manager->persist($page1);
        $manager->flush();

        // $page2 = new Page();
        // $page2->setName('zoo:pratique:acces')->setTitle('Accès')->setRoute('zpb_sites_zoo_utils_access')->setParent($page1)->setUrl($this->container->get('router')->generate('zpb_sites_zoo_utils_access',[],false));
        // $manager->persist($page2);

        // $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 2;
    }
}
