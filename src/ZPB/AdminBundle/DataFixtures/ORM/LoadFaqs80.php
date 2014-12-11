<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 11/12/2014
 * Time: 17:18
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
use ZPB\AdminBundle\Entity\FAQ;

class LoadFaqs80 extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $faq1 = new FAQ();
        $faq1->setQuestion("Qui a créé Beauval ?")
            ->setResponse("Beauval a été créé en 1980 par Françoise Delord, passionnée d’oiseaux et du monde animal. Un pari fou devenu une extraordinaire réussite : N° 1 des Zoos et Aquariums de France (classement Trip Advisor, Traveler’s Choice Attractions Awards 2014), Beauval a même été classé parmi les 15 plus beaux zoos du monde (par Forbes Traveler) !")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq1);

        $faq2 = new FAQ();
        $faq2->setQuestion("Quel est le nombre d'espèces présentes à Beauval ?")
            ->setResponse("Beauval héberge 5700 animaux de 600 espèces différentes.")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq2);

        $faq3 = new FAQ();
        $faq3->setQuestion("Quelle quantité de nourriture est distribuée aux animaux chaque jour ?")
            ->setResponse("La consommation de nourriture à Beauval s’élève à trois tonnes quotidiennes !")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq3);

        $faq4 = new FAQ();
        $faq4->setQuestion("Peut-on nourrir les animaux ?")
            ->setResponse("Chaque animal suit un régime alimentaire adapté à son espèce ; lui servir des aliments non compris dans ce régime peut le rendre gravement malade. Il est donc strictement interdit de nourrir les animaux, hormis les poissons des cours d’eau de Beauval et les animaux de la mini-ferme (pop-corn non salé vendu à l’entrée du Zoo).")
            ->setSite($this->getReference("site-zoo")) ;
        $manager->persist($faq4);

        $faq5 = new FAQ();
        $faq5->setQuestion("Quelle est la superficie de Beauval ?")
            ->setResponse("Le ZooParc s'étend sur environ 30 hectares.")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq5);




        $faq6 = new FAQ();
        $faq6->setQuestion("En combien de temps visite-t-on Beauval ?")
            ->setResponse("La majeure partie des visiteurs passe une journée entière à Beauval. Nous leur conseillons d’arriver tôt le matin pour profiter au mieux des animaux. Il est néanmoins possible d’effectuer la visite en moins de temps, un minimum de 5 heures étant vivement recommandé, en tenant compte des horaires de représentation des spectacles d’oiseaux, \"Les Maîtres des Airs\", et d’otaries, \"L’Odyssée des lions de mer\".")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq6);

        $faq7 = new FAQ();
        $faq7->setQuestion("Peut-on déjeuner à Beauval ?")
            ->setResponse("Oui, 9 points de vente proposent plats chauds ou formules de restauration rapide : un self-service, un restaurant spécialisé dans les burgers, une crêperie et 6 terrasses jalonnent le parcours des visiteurs. Tous ne sont pas quotidiennement ouverts ; consulter le panneau d’affichage à l’entrée du Zoo ou notre site mobile.")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq7);

        $faq8 = new FAQ();
        $faq8->setQuestion("Peut-on pique-niquer dans le Zoo ?")
            ->setResponse("Non, les pique-niques sont interdits à l’intérieur du Zoo. Une aire de 300 places, abritant tables et bancs, sont à disposition sur le parking. Il est possible d’entrer au Zoo et de ressortir pique-niquer, à condition de se faire délivrer un tampon de sortie en boutique.")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq8);

        $faq9 = new FAQ();
        $faq9->setQuestion("Le Zoo est-il fermé durant l’hiver ?")
            ->setResponse("Le Zoo est ouvert tous les jours de l’année, dès 9h (sauf conditions climatiques exceptionnelles pouvant affecter la circulation et/ou la sécurité des usagers de Beauval).")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq9);

        $faq10 = new FAQ();
        $faq10->setQuestion("Que faire si un enfant s’égare ?")
            ->setResponse("Adressez-vous aux équipes de l’un des points de restauration ; tous les membres de Beauval sont en liaison permanente par talkie-walkie. L’enfant concerné sera accompagné à l'Accueil du Zoo (entrée).")
            ->setSite($this->getReference("site-zoo"));
        $manager->persist($faq10);


        $manager->flush();
    }
    
    public function getOrder()
    {
        return 80;
    }
}
