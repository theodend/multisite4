<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 13/12/2014
 * Time: 09:40
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


abstract class AbstractShortCode
{
    abstract public function parse($params);
}
