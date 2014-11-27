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
        $page1->setName('homepage')->setTitle('Accueil')->setRoute('/');

        $page2 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');

        $page3 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');

        $page4 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');

        $page5 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');

        $page6 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');

        $page7 = new Page();
        $page1->setName('homepage')->setTitle('')->setRoute('');
    }
    
    public function getOrder()
    {
        return 1;
    }
}
