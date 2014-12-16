<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 16/12/2014
 * Time: 15:55
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

class PDFUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename','text', ['label'=>'Nom du fichier'])
            ->add('title','textarea',['label'=>'Texte de l\'attribut title'])
            ->add('copyright','text',['label'=>'Texte du copyright sans le sigle'])
            ->add('save', 'submit', ['label'=>'Mettre à jour'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PDF']);
    }
    
    public function getName()
    {
        return 'pdf_update_form';
    }
}
