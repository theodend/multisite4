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
        $resto1->setImage("/img/sites/zoo/restauration/1418298921.jpeg")
            ->setDescription("Implanté au centre du Zoo, Le Tropical propose entrées, plats chauds, assiettes fromagères, desserts, glaces, boissons et Menus Enfants. À l’étage, s’offre une vue panoramique sur la piscine des otaries, tandis que les terrasses extérieures bordent le cours d’eau et ses îles investies par les primates.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Le Tropical")->setNum("1")->setThumb("/img/sites/zoo/restauration/thumb/1418298921.jpeg");
        $manager->persist($resto1);

        $resto2 = new Restaurant();
        $resto2->setImage("/img/sites/zoo/restauration/1418299026.jpeg")
            ->setDescription("Près de grandes aires de jeux, un restaurant panoramique du nom du célèbre \"Kilimandjaro\" domine l'aire du spectacle d'oiseaux. Au menu : hamburgers, steaks frites, nuggets, salades… En salle ou en terrasse, pour allier plaisirs des yeux et des papilles !")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Le Kilimandjaro")->setNum("2")->setThumb("/img/sites/zoo/restauration/thumb/1418299026.jpeg");
        $manager->persist($resto2);

        $resto3 = new Restaurant();
        $resto3->setImage("/img/sites/zoo/restauration/1418299081.jpeg")
            ->setDescription("En terrasse, les galettes salées et crêpes sucrées sont à déguster au déjeuner comme au goûter ! Sandwichs, salades, glaces et boissons viennent compléter l’offre de La Roseraie.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Roseraie")->setNum("3")->setThumb("/img/sites/zoo/restauration/thumb/1418299081.jpeg");
        $manager->persist($resto3);

        $resto4 = new Restaurant();
        $resto4->setImage("/img/sites/zoo/restauration/1418299131.jpeg")
            ->setDescription("Une pause adorée des enfants ! Ente une grande aire de jeux et un carrousel animalier, une terrasse ombragée accueille les pauses familiales dans une ambiance musicale. Sandwichs, pizzas, croque-monsieur, salades, glaces et boissons.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("L'Eucalyptus")->setNum("4")->setThumb("/img/sites/zoo/restauration/thumb/1418299131.jpeg");
        $manager->persist($resto4);

        $resto5 = new Restaurant();
        $resto5->setImage("/img/sites/zoo/restauration/1418299167.jpeg")
            ->setDescription("Restauration à la chinoise ? Sur les bien-nommées Hauteurs de Chine, non loin des pandas géants, sont proposés nems, beignets de crevettes, poulet-curry ou thé au jasmin, dans un remarquable décor chinois !")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Pagode")->setNum("5")->setThumb("/img/sites/zoo/restauration/thumb/1418299167.jpeg");
        $manager->persist($resto5);

        $resto6 = new Restaurant();
        $resto6->setImage("/img/sites/zoo/restauration/1418299205.jpeg")
            ->setDescription("Une pause déjeuner face au girafes, ponctuée par les bonds des springboks ? En bordure de la Savane Africaine, ce point de restauration à la vue imprenable propose sandwichs, hot-dogs, glaces et boissons.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("La Savane")->setNum("6")->setThumb("/img/sites/zoo/restauration/thumb/1418299205.jpeg");
        $manager->persist($resto6);


        $resto7 = new Restaurant();
        $resto7->setImage("/img/sites/zoo/restauration/1418299242.jpeg")
            ->setDescription("Face à l’île des orangs outans, une terrasse ombragée permet de consommer, en toute tranquillité, sandwichs, croque-monsieur, saucisses-frites, salades, pizzas, gaufres, glaces et boissons.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Orangs-outans")->setNum("7")->setThumb("/img/sites/zoo/restauration/thumb/1418299242.jpeg'");
        $manager->persist($resto7);

        $resto8 = new Restaurant();
        $resto8->setImage("/img/sites/zoo/restauration/1418299374.jpg")
            ->setDescription("Niché à la sortie de la Serre tropicale des Lamantins, ce comptoir, doté d’une petite terrasse, propose glaces, boissons et granités.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Lamantins")->setNum("8")->setThumb("/img/sites/zoo/restauration/thumb/1418299374.jpg");
        $manager->persist($resto8);

        $resto9 = new Restaurant();
        $resto9->setImage("/img/sites/zoo/restauration/1418299456.jpeg")
            ->setDescription("Jouxtant la Plaine Asiatique, ce point de restauration rapide permet d’effectuer une brève halte et de consommer hot-dogs, gaufres, glaces, boissons, avant de poursuivre sa visite.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Les Chats Pêcheurs")->setNum("9")->setThumb("/img/sites/zoo/restauration/thumb/1418299456.jpeg");
        $manager->persist($resto9);



        $resto10 = new Restaurant();
        $resto10->setImage("/img/sites/zoo/restauration/1418299497.jpg")
            ->setDescription("Attenant au self-service Le Tropical, à deux pas de la piscine des otaries, un comptoir délivre sandwichs, boissons, confiseries et sculpturales glaces à l’italienne ! Pour se restaurer tout en poursuivant sa visite…")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Glaces à l’italienne")->setNum("10")->setThumb("/img/sites/zoo/restauration/thumb/1418299497.jpg");
        $manager->persist($resto10);

        $resto11 = new Restaurant();
        $resto11->setImage("/img/sites/zoo/restauration/1418299552.jpeg")
            ->setDescription("Les pique-niques sont interdits à l’intérieur du Zoo. Une aire de 300 places, abritant tables et bancs, est à disposition sur le parking. Il est possible d’entrer au Zoo et de ressortir pique-niquer, à condition de se faire délivrer un tampon de sortie en boutique.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Pique-niques")->setNum("11")->setThumb("/img/sites/zoo/restauration/thumb/1418299552.jpeg");
        $manager->persist($resto11);

        $resto12 = new Restaurant();
        $resto12->setImage("/img/sites/zoo/restauration/1418299634.jpeg")
            ->setDescription("Labellisés \"Maître Restaurateur\", les restaurants Le Tegallalang (Les Jardins de Beauval) et Le Sichuan (Les Pagodes de Beauval) restent accessibles aux non-résidents des hôtels pour les déjeuners et dîners (selon saison). Tous deux proposent une carte de saison savamment élaborée.")
            ->setImageRoot("/var/www/vhosts/multisite4/app/../web/")->setIsOpen(true)->setName("Hôtels de Beauval")->setNum("12")->setThumb("/img/sites/zoo/restauration/thumb/1418299634.jpeg");
        $manager->persist($resto12);


        $manager->flush();

        // $this->addReference('', );
    }

    public function getOrder()
    {
        return 30;
    }
}
