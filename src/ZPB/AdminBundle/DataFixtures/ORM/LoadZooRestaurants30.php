<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 01/12/2014
 * Time: 01:17
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
use ZPB\AdminBundle\Entity\Restaurant;

/**
 * Class LoadZooRestaurants
 * @package
 */
class LoadZooRestaurants30  extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $resto1 = new Restaurant();
        $resto1->setImage("/img/sites/zoo/restauration/1417993006.jpeg")->setDescription("Au carrefour de nombreuses allées du ZooParc, Le Tropical propose <strong>entrées</strong>,<strong> plats chauds, desserts, glaces et boissons</strong>. Vous pouvez profiter d'une vue panoramique sur la piscine des otaries (premier étage) ou bien préférer les terrasses extérieures qui donnent sur le cours d’eau et  ses îles investies par macaques et atèles. Un lieu d'accueil idéal pour les groupes.")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Le Tropical")->setNum("1")->setThumb("/img/sites/zoo/restauration/thumb/1417993006.jpeg");
        $manager->persist($resto1);

        $resto2 = new Restaurant();
        $resto2->setImage("/img/sites/zoo/restauration/1417993151.jpeg")->setDescription("Un restaurant à vision panoramique portant le nom du célèbre sommet tanzanien, \"Le Kilimandjaro\", domine l'aire du spectacle d'oiseaux. <strong>Au menu&nbsp;: hamburgers, steaks frites, nuggets, salades</strong> Pour allier plaisirs des yeux et des papilles&nbsp;!")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Le Kilimandjaro")->setNum("2")->setThumb("/img/sites/zoo/restauration/thumb/1417993151.jpeg");
        $manager->persist($resto2);

        $resto3 = new Restaurant();
        $resto3->setImage("/img/sites/zoo/restauration/1417993241.jpeg")->setDescription("Une terrasse recouverte de roses,  face aux tigres blancs et surplombant l’un des plans d’eau du ZooParc. Appréciées des visiteurs, <strong>les galettes et les crêpes</strong> de Beauval sont à déguster au déjeuner comme au goûter&nbsp;! Vous y trouverez également <strong>sandwichs, salades, glaces et boissons.</strong>")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Ros")->setNum("3")->setThumb("/img/sites/zoo/restauration/thumb/1417993241.jpeg");
        $manager->persist($resto3);

        $resto4 = new Restaurant();
        $resto4->setImage("/img/sites/zoo/restauration/1417993291.jpeg")->setDescription("Une pause adorée des enfants&nbsp;: près d'une grande aire de jeux,  un magnifique carrousel leur est proposé. Pendant un moment de détente sur la terrasse ombragée, vos enfants seront heureux de chevaucher un lion ou une girafe. <strong>Sandwichs, pizzas, croque-monsieur, salades, glaces et boissons.")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("L'Eucalyptus")->setNum("4")->setThumb("/img/sites/zoo/restauration/thumb/1417993291.jpeg");
        $manager->persist($resto4);

        $resto5 = new Restaurant();
        $resto5->setImage("/img/sites/zoo/restauration/1417993324.jpeg")->setDescription("Restauration à la chinoise&nbsp;? Prenez du temps sur les Hauteurs de Chine et dégustez <strong>nems, beignets de crevettes et thé au jasmin</strong> (mais aussi pizzas plus classiques) dans un décor chinois à couper le souffle&nbsp;!")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Pagode")->setNum("5")->setThumb("/img/sites/zoo/restauration/thumb/1417993324.jpeg");
        $manager->persist($resto5);
        $resto6 = new Restaurant();
        $resto6->setImage("/img/sites/zoo/restauration/1417993368.jpeg")->setDescription("Prenez votre petit-déjeuner en observant les girafes. Faites une pause déjeuner en suivant des yeux les rhinocéros, les bonds des springboks ou la course des autruches… En bordure de la savane, ce point de restauration vous propose <strong>sandwichs, hot-dogs, glaces et boissons.")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Savane")->setNum("6")->setThumb("/img/sites/zoo/restauration/thumb/1417993368.jpeg");
        $manager->persist($resto6);


        $resto7 = new Restaurant();
        $resto7->setImage("/img/sites/zoo/restauration/1417993431.jpeg")->setDescription("Devant l’île des orangs-outans, une terrasse ombragée vous permet de consommer en toute tranquillité <strong>plats chauds, salades, pizzas, glaces et boissons.</strong>")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Orangs-outans")->setNum("7")->setThumb("/img/sites/zoo/restauration/thumb/1417993431.jpeg'");
        $manager->persist($resto7);

        $resto8 = new Restaurant();
        $resto8->setImage("/img/sites/zoo/restauration/1417993479.jpeg")->setDescription("À la sortie de la serre tropicale des lamantins, découvrez un petit coin à part où vous pouvez acheter<strong> glaces, boissons et granités</strong>. Quelques tables, avec vue sur l’île des gorilles, vous offrent un repos agréable.")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Lamantins")->setNum("8")->setThumb("/img/sites/zoo/restauration/thumb/1417993479.jpeg");
        $manager->persist($resto8);

        $resto9 = new Restaurant();
        $resto9->setImage("/img/sites/zoo/restauration/1417993522.jpeg")->setDescription("Un point de restauration rapide près de la nouvelle plaine asiatique. Déjeunez  rapidement et profitez pleinement de votre journée en vous promenant. <strong>Hot-dogs,  gaufres, glaces et boissons</strong> réjouiront petits et grands.")->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Chats Pêcheurs")->setNum("9")->setThumb("/img/sites/zoo/restauration/thumb/1417993522.jpeg");
        $manager->persist($resto9);




        $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 30;
    }
}
