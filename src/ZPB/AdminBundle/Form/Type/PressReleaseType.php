<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 16/12/2014
 * Time: 17:13
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

namespace ZPB\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PressReleaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', ['label'=>'Titre'])
            ->add('body','textarea', ['label'=>'Corps'])
            ->add('image', 'hidden')
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PressRelease']);
    }
    
    public function getName()
    {
        return 'press_release_form';
    }
}
