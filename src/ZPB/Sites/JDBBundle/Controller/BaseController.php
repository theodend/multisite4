<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 03/12/2014
 * Time: 17:48
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

namespace ZPB\Sites\JDBBundle\Controller;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class BaseController extends ZPBController
{
    protected $site = "jdb";

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
