<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 29/11/2014
 * Time: 16:17
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

namespace ZPB\AdminBundle\Controller\BN;


use ZPB\Sites\CommonBundle\Controller\ZPBController;

class BaseController extends ZPBController
{
    protected $defaultSite = "bn";
}
