<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AyudantesOperacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('operacionFk',EntityType::class, array( 'class' => 'AppBundle:Operacion', 'choice_label' => 'idOperacion'))
//            ->add('personalFk');
            ->add('personalFk',EntityType::class, array( 'class' => 'AppBundle:Personal', 'choice_label' => 'idPersonal'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\AyudantesOperacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ayudantesoperacion';
    }


}
