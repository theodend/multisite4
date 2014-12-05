<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 05/12/2014
 * Time: 14:03
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

namespace ZPB\Sites\ProBundle\Controller;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class BaseController extends ZPBController
{
    protected $site = "pro";

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     * @return $this
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
    }
} 
