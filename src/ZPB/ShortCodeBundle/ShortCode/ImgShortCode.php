<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 14:07
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

class ImgShortCode  extends AbstractShortCode
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $template = "<img %s />";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parse($params)
    {

        $string = "";
        $typePat =  "/(?:[^\s]*)\s*(?P<type>route|url)=(?:\"\s*)?(?P<src>[^\"\s]+)(?:\s*\")?\s*(?:[^\s]*)/";
        $wPat =     "/(?:[^\s]*)\s*width=(?:\"\s*)?(?P<width>[^\"\s]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $hPat =     "/(?:[^\s]*)\s*height=(?:\"\s*)?(?P<height>[^\"\s]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $titlePat = "/(?:[^\s]*)\s*title=(?:\"\s*)?(?P<title>[^\"]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $altPat =   "/(?:[^\s]*)\s*alt=(?:\"\s*)?(?P<alt>[^\"]*)(\s*\")(?:\s*\")?\s*(?:[^\s]*)/";

        $option = trim($params["params"], " ");

        if(preg_match($typePat, $params["params"], $matches)){
            $type = $matches["type"];
            if(!in_array($type, ["route","url"]) || empty($matches["src"])){
                return $string;
            }
            if($type == "url"){
                $string .= " src='" . $matches["src"] . "' ";
            }
            if($type == "route"){
                $router = $this->container->get("router");
                try{
                    $url = $router->generate($matches["src"]);
                    $string .= " src='" . $url . "' " ;
                } catch(\Exception $e){
                    return $string = "";
                }
            }


        } else {
            return $string;
        }

        if(preg_match($wPat, $params["params"], $matches)){
            $string .= " width='" . $matches["width"] . "' ";
        }

        if(preg_match($hPat, $params["params"], $matches)){
            $string .= " height='" . $matches["height"] . "' ";
        }

        if(preg_match($titlePat, $params["params"], $matches)){
            $string .= " title='" . $matches["title"] . "' ";
        }

        if(preg_match($altPat, $params["params"], $matches)){
            $string .= " alt='" . $matches["alt"] . "' ";
        }

        return sprintf($this->template, $string);
    }
}
