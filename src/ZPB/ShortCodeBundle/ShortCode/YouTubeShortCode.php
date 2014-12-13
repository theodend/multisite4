<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 15:56
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

class YouTubeShortCode extends AbstractShortCode
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $template = "<iframe %s frameborder=\"0\" allowfullscreen></iframe>";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parse($params)
    {
        $string = "";

        $idPat =    "/(?:[^\s]*)\s*id=(?:\"\s*)?(?P<id>[^\"\s]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $wPat =     "/(?:[^\s]*)\s*width=(?:\"\s*)?(?P<width>[^\"\s]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $hPat =     "/(?:[^\s]*)\s*height=(?:\"\s*)?(?P<height>[^\"\s]*)(?:\s*\")?\s*(?:[^\s]*)/";

        if(preg_match($idPat, $params["params"], $matches)){
            $string .= " src='//www.youtube.com/embed/".$matches["id"]."?rel=0' ";
        } else {
            return $string;
        }

        if(preg_match($wPat, $params["params"], $matches)){
            $string .= " width='" . $matches["width"] . "' ";
        }

        if(preg_match($hPat, $params["params"], $matches)){
            $string .= " height='" . $matches["height"] . "' ";
        }

        return sprintf($this->template, $string);
    }
}
