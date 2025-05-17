<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
            ->add('registroProfesional')
            ->add('activo')
//            ->add('nivelProfesionalFk')
            ->add('nivelProfesionalFk',EntityType::class, array( 'class' => 'AppBundle:NivelProfesional', 'choice_label' => 'nombreCorto', 'label' => 'Nivel Profesional'))
//            ->add('tipoPersonalFk');
            ->add('tipoPersonalFk',EntityType::class, array( 'class' => 'AppBundle:TipoPersonal', 'choice_label' => 'nombre', 'label' => 'Tipo de Personal'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Personal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_personal';
    }


}
