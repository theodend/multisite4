<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 08:51
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

namespace ZPB\ShortCodeBundle\Twig\Extension;


use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\ShortCodeBundle\Helper\ShortCodeHelper;

class ShortCodeExtension extends \Twig_Extension{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $helper;

    public function __construct(ShortCodeHelper $helper, ContainerInterface $container)
    {
        $this->helper = $helper;
        $this->container = $container;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter("shortcodes", [$this, "parse"], ["is_safe"=>["html"]]),
        ];
    }

    public function parse($content)
    {
        return $this->helper->parse($content);
    }

    public function getName()
    {
        return "zpb_shortcodes";
    }
}
