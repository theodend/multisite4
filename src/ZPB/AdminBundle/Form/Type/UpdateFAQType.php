<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/12/2014
 * Time: 23:38
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

class UpdateFAQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $SiteTransformer = new SiteTransformer($em);
        $builder
            ->add('question', 'textarea', ['label' => 'La question'])
            ->add('response', 'textarea', ['label' => 'La réponse'])
            ->add(
                $builder->create(
                    'site',
                    'entity',
                    [
                        'label'      => 'Site',
                        'class'      => 'ZPBAdminBundle:Site',
                        'data_class' => 'ZPB\AdminBundle\Entity\Site',
                        'property'   => 'name'
                    ]
                )->addModelTransformer($SiteTransformer)
            )
            ->add('save', 'submit', ['label' => 'Mettre à jour']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => 'ZPB\AdminBundle\Entity\FAQ']);
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em' => '\Doctrine\Common\Persistence\ObjectManager']);
    }

    public function getName()
    {
        return 'update_faq_form';
    }
}
