<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 16/12/2014
 * Time: 10:48
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

class PDFType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file', ['label'=>'Fichier PDF'])
            ->add('filename','text', ['label'=>'Nom du fichier'])
            ->add('title','textarea',['label'=>'Texte de l\'attribut title'])
            ->add('copyright','text',['label'=>'Texte du copyright sans le sigle'])
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\PDF']);
    }
    
    public function getName()
    {
        return 'pdf_form';
    }
}
