<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 02/12/2014
 * Time: 05:40
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

namespace ZPBAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\AdminBundle\Entity\Site;

/**
 * Class LoadSites
 * @package ZPBAdminBundle\DataFixtures\ORM
 */
class LoadSites  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $site1 = new Site();
        $site1->setName('ZooParc de Beauval')->setShortname('zoo')->setRoute('zpb_sites_zoo_homepage')->setUrl('http://zoobeauval.com');
        $manager->persist($site1);


        $site2 = new Site();
        $site2->setName('Beauval Nature')->setShortname('bn')->setRoute('zpb_sites_bn_homepage')->setUrl('http://beauvalnature.com');
        $manager->persist($site2);


        $site3 = new Site();
        $site3->setName('Pro')->setShortname('pro')->setRoute('zpb_sites_pro_homepage')->setUrl('http://pro.zoobeauval.com');
        $manager->persist($site3);


        $site4 = new Site();
        $site4->setName('Sco')->setShortname('sco')->setRoute('zpb_sites_sco_homepage')->setUrl('http://scolaires.zoobeauval.com');
        $manager->persist($site4);


        $site5 = new Site();
        $site5->setName('CE')->setShortname('ce')->setRoute('zpb_sites_ce_homepage')->setUrl('http://ce.zoobeauval.com');
        $manager->persist($site5);

        $manager->flush();

        $this->addReference('site-zoo', $site1);
        $this->addReference('site-bn', $site2);
        $this->addReference('site-pro', $site3);
        $this->addReference('site-sco', $site4);
        $this->addReference('site-ce', $site5);
    }

    public function getOrder()
    {
        return 8;
    }
}
