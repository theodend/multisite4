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
use Symfony\Component\Form\Form;
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

    /**
     * @param string $view
     * @param Request $request
     * @param array $datas
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getView($view = '', Request $request = null, $datas = [])
    {
        if(array_key_exists('page', $datas)){
            throw new \RuntimeException('page already existe !');
        }
        if($request !== null){
            $datas['page'] = $this->getPage($request);
        }

        return $this->render($view, $datas);
    }

    public function getInput(Request $request)
    {
        $inputs = [];
        parse_str($request->getContent(), $inputs);
        return $inputs;

    }

    /**
     * @return \Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter
     */
    public function getCsrf()
    {
        if(!$this->container->has('form.csrf_provider')){
            throw new \LogicException('The form.csrf_provider is undefined in container');
        }
        return $this->get('form.csrf_provider');
    }

    /**
     * @param string $token
     * @param string $intention
     * @return bool
     */
    public function validateToken($token = '', $intention='')
    {
        if(!$token || !$this->getCsrf()->isCsrfTokenValid($intention, $token)){
            return false;
        }
        return true;
    }

    protected function getFormErrors($form) {
        $errors = [];
        if ($form instanceof Form) {
            foreach ($form->getErrors() as $error) {

                $errors[] = $error->getMessage();
            }

            foreach ($form->all() as $key => $child) {
                /** @var $child Form */
                if ($err = $this->getFormErrors($child)) {
                    $errors[$key] = $err;
                }
            }
        }
        return $errors;
    }
}
