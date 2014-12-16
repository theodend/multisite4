<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 14:55
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
namespace ZPB\AdminBundle\Controller\Press;

use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\PressRelease;
use ZPB\AdminBundle\Form\Type\PressReleaseType;
use ZPB\Sites\CommonBundle\Controller\ZPBController;

class PressReleaseController extends ZPBController
{
    public function indexAction(Request $request)
    {
        $docs = $this->getRepo("ZPBAdminBundle:PressRelease")->findAll();
        $pr = new PressRelease();
        $form = $this->createForm(new PressReleaseType(), $pr);
        $form->handleRequest($request);
        if($form->isValid()){


            return $this->redirect($this->generateUrl("zpb_admin_press_release_homepage"));
        }

        return $this->render('ZPBAdminBundle:Press/PressRelease:index.html.twig', ["docs"=>$docs]);
    }
}
