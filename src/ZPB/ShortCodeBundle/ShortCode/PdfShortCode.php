<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 16:20
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

class PdfShortCode  extends AbstractShortCode
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $template = "<a %s >%s</a>";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function parse($params)
    {
        $string = "";
        $filePat = "/(?:[^\s]*)\s*filename=(?:\"\s*)?(?P<src>[^\"\s]+)(?:\s*\")?\s*(?:[^\s]*)/";
        $titlePat = "/(?:[^\s]*)\s*title=(?:\"\s*)?(?P<title>[^\"]*)(?:\s*\")?\s*(?:[^\s]*)/";
        $altPat =   "/(?:[^\s]*)\s*alt=(?:\"\s*)?(?P<alt>[^\"]*)(\s*\")(?:\s*\")?\s*(?:[^\s]*)/";
        $classPat = "/(?:[^\s]*)\s*class=(?:\"\s*)?(?P<class>[^\"]*)(\s*\")(?:\s*\")?\s*(?:[^\s]*)/";

        if(preg_match($filePat, $params["params"], $matches)){
            $filename = $matches["src"];
        } else {
            return "";
        }

        $internal = (empty($params["internals"])) ? $filename : $params["internals"];

        $url = "/telechargements/pdf/" . $filename;

        $string .= ' href="' . $url . '" ';

        if(preg_match($titlePat, $params["params"], $matches)){
            $string .= " title='" . $matches["title"] . "' ";
        }

        if(preg_match($altPat, $params["params"], $matches)){
            $string .= " alt='" . $matches["alt"] . "' ";
        }

        if(preg_match($classPat, $params["params"], $matches)){
            $string .= " class='" . $matches["class"] . "' ";
        }

        return sprintf($this->template, $string, $internal);
    }


}
