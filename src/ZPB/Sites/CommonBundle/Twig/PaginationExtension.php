<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 13/12/2014
 * Time: 00:03
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


use Symfony\Component\DependencyInjection\ContainerInterface;

class PaginationExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction("pagination", [$this, "renderPagination"], ["is_safe"=>["html"]]),
        ];
    }

    public function renderPagination($pagination, $minPageForArrows = 5)
    {
        $file = $this->container->getParameter("zpb.pagination.twig_template");
        return $this->container->get("templating")->render($file, ["pagination"=>$pagination, "minPageForArrows"=>$minPageForArrows]);
    }

    public function getName()
    {
        return 'zpb_pagination';
    }
}
