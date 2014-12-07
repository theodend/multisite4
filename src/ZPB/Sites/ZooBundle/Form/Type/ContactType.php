<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 23/09/2014
 * Time: 11:37
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

namespace ZPB\Sites\ZooBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('interlocutor', 'contact_interlocutors_type', ['label'=>'Choisissez votre interlocuteur'])
            ->add('email','email', ['label'=>'Votre email *'])
            ->add('topic',null, ['label'=>'Objet'])
            ->add('message','textarea', ['label'=>'Votre message *'])
            ->add('name','text',['required'=>false,'label'=>'Si vous êtes un humain ne remplissez pas ce champs', 'mapped'=>false])
            ->add('save', 'submit', ['label'=>'Envoyer'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Contact']);
    }

    public function getName()
    {
        return 'info_fr_zoo_contact_form';
    }
}
