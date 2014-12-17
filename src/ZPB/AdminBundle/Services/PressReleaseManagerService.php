<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 17/12/2014
 * Time: 10:00
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

namespace ZPB\AdminBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class PressReleaseManagerService {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var EntityManager
     */
    private $em;

    private $errors = null;

    public function __construct(ContainerInterface $container, EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
    }

    public function createFormHandle(Form $form, Request $request)
    {
        if(!$request->isMethod("POST") || !$request->isXmlHttpRequest()){
            return false;
        }

        $form->handleRequest($request);

        if($form->isValid()){
            $this->create($form->getData());
            return true;
        }
        $this->errors = $this->getErrors($form);
        return false;
    }

    public function create($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function getFormErrors()
    {
        return $this->errors;
    }

    protected function getErrors($form)
    {
        $errors = [];
        if ($form instanceof Form) {
            foreach ($form->getErrors() as $error) {

                $errors[] = $error->getMessage();
            }

            foreach ($form->all() as $key => $child) {
                /** @var $child Form */
                if ($err = $this->getErrors($child)) {
                    $errors[$key] = $err;
                }
            }
        }
        return $errors;

    }

}
