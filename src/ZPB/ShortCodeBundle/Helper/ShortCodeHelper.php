<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 09:34
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

namespace ZPB\ShortCodeBundle\Helper;


use Symfony\Component\Templating\Helper\Helper;

class ShortCodeHelper extends Helper
{
    private $shortcodes = [];

    public function addShortCode($alias, $shortcode)
    {
        $this->shortcodes[$alias] = $shortcode;
    }

    public function shotCodesList()
    {
        return join("|", array_keys($this->shortcodes));
    }

    public function parse($content)
    {
        $tagsList = $this->shotCodesList();

        //$content = preg_replace_callback("/\[(?P<tag>$tagsList)(?P<params>[^\]]*?)?\](?:(?P<internals>[^\[]+?)?\[\/\1\])?/", [$this, "parseShortCodes"], $content);
        $content = preg_replace_callback("/\[(?P<tag>$tagsList)\s*(?P<params>[^\]]*?)?\](?:(?P<internals>[^\[]+?)?\[\/\\1\])?/", [$this, "parseShortCodes"], $content);
        return $content;
    }

    public function parseShortCodes($params)
    {
        /** @var \ZPB\ShortCodeBundle\ShortCode\AbstractShortCode $shortcode */
        $shortcode = $this->shortcodes[$params["tag"]];

        return $shortcode->parse($params);
    }

    public function getName()
    {
        return "zpb_shortcode";
    }
}
