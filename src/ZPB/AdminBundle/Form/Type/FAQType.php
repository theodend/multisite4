<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/09/2014
 * Time: 17:40
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
use ZPB\AdminBundle\Form\DataTransformer\SiteTransformer;

class FAQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $SiteTransformer = new SiteTransformer($em);
        $builder
            ->add('question','textarea', ['label'=>'La question'])
            ->add('response','textarea', ['label'=>'La réponse'])
            ->add(
                $builder->create(
                    'site',
                    'entity',
                    [
                        'label'=>'Site',
                        'class'=>'ZPBAdminBundle:Site',
                        'data_class'=>'ZPB\AdminBundle\Entity\Site',
                        'property'=>'name'
                    ]
                )->addModelTransformer($SiteTransformer)
            )
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class'=>'ZPB\AdminBundle\Entity\FAQ']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }

    public function getName()
    {
        return 'faq_form';
    }
}
