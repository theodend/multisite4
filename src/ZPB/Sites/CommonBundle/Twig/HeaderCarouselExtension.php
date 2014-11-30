<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 30/11/2014
 * Time: 15:21
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

namespace ZPB\Sites\CommonBundle\Twig;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HeaderCarouselExtension extends \Twig_Extension {

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

    private $site = 'zoo';

    public function __construct(ContainerInterface $container, ObjectManager $manager)
    {
        $this->container = $container;
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('header_carousel', [$this, 'renderHeaderCarousel'], ['is_safe'=>['html']])
        ];
    }

    function renderHeaderCarousel($twigFile, $site="")
    {
        if($site == ""){
            $site = $this->site;
        }
        $slider = $this->manager->getRepository('ZPBAdminBundle:HeaderCarousel')->findOneBySite($site);
        $slides = $this->manager->getRepository('ZPBAdminBundle:HeaderCarouselSlide')->findBy(['slider'=>$slider,'isActive'=>true], ['position'=>'ASC']);
        return $this->getService('templating')->render($twigFile, ['slider'=>$slider, 'slides'=>$slides]);
    }

    public function getService($service, $default = null)
    {
        if($this->container->has($service)){
            return $this->container->get($service);
        }
        return $default;

    }


    public function getName()
    {
        return 'zpb_header_carousel_extension';
    }
}
