<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 10:12
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

namespace ZPB\ShortCodeBundle\ShortCode;


use Symfony\Component\DependencyInjection\ContainerInterface;

class LinkShortCode extends AbstractShortCode
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $template = "<a href='%s'>%s</a>";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parse($params)
    {

        $pattern = "/(?P<type>route|url)=(?:\"\s*)?(?P<value>[^\"\s]+)(?:\s*\")?/";
        $option = trim($params["params"], " ");
        if(empty($params["internals"])){
            $params["internals"] = null;
        }
        if(preg_match($pattern, $params["params"], $matches)){
            if($matches["type"] === "url"){
                return $this->makeUrl($matches["value"], $params["internals"]);
            }
            if($matches["type"] === "route"){
                return $this->makeRoute($matches["value"], $params["internals"]);
            }
        }
        return "";
    }

    private function makeUrl($url, $internal)
    {
        if($internal === null){
            $internal = $url;
        }
        return sprintf($this->template, $url, $internal);
    }

    private function makeRoute($route, $internal)
    {
        $router = $this->container->get("router");
        try{
            $url = $router->generate($route,[], true);
            $string = $this->makeUrl($url, $internal);
        } catch(\Exception $e){
            $string = "";
        }
        return $string;
    }


}
