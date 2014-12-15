<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 15/12/2014
 * Time: 10:22
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

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null, ['label'=>'Titre'])
            ->add('excerpt','textarea', ['label'=>'Extrait'])
            ->add('body','textarea', ['label'=>'Corps'])
            ->add('saveDraft', 'submit', ['label'=>'Enregistrer le brouillon'])
            ->add('savePublish', 'submit', ['label'=>'Enregistrer et publier'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\Post']);
    }
    
    public function getName()
    {
        return 'post_form';
    }
}
