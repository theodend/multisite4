<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 28/11/2014
 * Time: 17:27
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\AdminBundle\Entity\Contact;
use ZPB\Sites\ZooBundle\Form\Type\ContactType;

class ContactController extends BaseController
{
    public function indexAction(Request $request)
    {
        $contact = new Contact();
        $contact->setSource("ZooParc de Beauval");

        $form = $this->createForm(new ContactType(), $contact);

        $form->handleRequest($request);
        if($form->isValid()){
            $nonHuman = $form->get('name')->getData();
            if($nonHuman != null){
                throw $this->createAccessDeniedException();
            }

            $message = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('mail de contact')
                ->setFrom('nicolas.canfrere@zoobeauval.com') //TODO adresse mail
                ->setTo($this->container->getParameter('zpb.zoo.contact_interlocutors_emails')[$contact->getInterlocutor()])
                ->setBody($this->renderView('ZPBSitesZooBundle:Modeles:email_contact.html.twig',['contact'=>$contact, 'email'=>$this->container->getParameter('zpb.zoo.contact_interlocutors_emails')[$contact->getInterlocutor()]]))
            ;

            $sent = $this->get('mailer')->send($message);
            // TODO[Nicolas] feedback
            if($sent>0){
                $contact->setIsSend(true);
                //$this->setSuccess('Votre message a bien été envoyé.');
            }else {
                $contact->setIsSend(false);
                //$this->setError('Un problème est survenu !');
            }
            $this->getManager()->persist($contact);
            $this->getManager()->flush();

            return $this->redirect($this->generateUrl("zpb_sites_zoo_contact"));
        }
        return $this->getView('ZPBSitesZooBundle:Contact:index.html.twig', $request, ['form'=>$form->createView()]);
    }
}
