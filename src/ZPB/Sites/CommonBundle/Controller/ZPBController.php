<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 25/11/2014
 * Time: 16:56
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

namespace ZPB\Sites\CommonBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ZPBController extends Controller
{

    /**
     * @param Request $request
     * @return \ZPB\AdminBundle\Entity\Page
     */
    public function getPage(Request $request)
    {
        $page = $this->getRepo('ZPBAdminBundle:Page')->findOneByRoute($this->getRouteName($request));
        return $page;
    }
    /**
     * @param Request $request
     * @return string
     */
    public function getRouteName(Request $request)
    {
        return $request->get('_route');
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param string $repo
     * @return \Doctrine\Common\Persistence\ObjectRepository|null
     */
    public function getRepo($repo = '')
    {
        if($repo == null){
            return null;
        }

        return $this->getDoctrine()->getRepository($repo);
    }
}
