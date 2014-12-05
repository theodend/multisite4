<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/12/2014
 * Time: 12:24
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

class AlertExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ContainerInterface $container, ObjectManager $manager)
    {
        $this->container = $container;
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('alert_manager', [$this, 'renderAlert'], ['is_safe'=>['html']])
        ];
    }

    public function renderAlert($site = "", $twigFile = "ZPBSitesCommonBundle:Incs:alert.html.twig")
    {
        if($twigFile == "" || $site == ""){
            return "";
        }
        $alert = $this->manager->getRepository("ZPBAdminBundle:Alert")->findOneByTarget($site);
        if(!$alert){
            return "";
        }

        return $this->getService("templating")->render($twigFile, ["alert"=>$alert]);
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
        return 'zpb_alert';
    }
}
