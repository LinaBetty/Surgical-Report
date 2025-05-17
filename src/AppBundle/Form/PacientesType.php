<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PacientesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('historiaClinica')->add('ci',TextType::class , array('label'=>'Carnet de Identidad',))
            ->add('nombre')->add('primerApellido')->add('segundoApellido')
//            ->add('estadoCivilFk')
            ->add('estadoCivilFk',EntityType::class, array( 'class' => 'AppBundle:EstadoCivil', 'choice_label' => 'nombre', 'label' => 'Estado Civil'))
//            ->add('razaFk')
            ->add('razaFk',EntityType::class, array( 'class' => 'AppBundle:Raza', 'choice_label' => 'nombre', 'label' => 'Raza'))
//            ->add('sexoFk');
            ->add('sexoFk',EntityType::class, array( 'class' => 'AppBundle:Sexo', 'choice_label' => 'nombre', 'label' => 'Sexo'))
            ->add('direccion', TextType::class)
            ->add('grupoSanguineo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array('choices' => array(
                'A+' => 'A+',
                'A-' => 'A-',
                'B+' => 'B+',
                'B-' => 'B-',
                'O+' => 'O+',
                'O-' => 'O-',
                'AB+' => 'AB+',
                'AB-' => 'AB-')))
            ->add('provinciaFk',EntityType::class, array( 'class' => 'AppBundle:Provincia', 'choice_label' => 'nombre', 'label' => 'Provincia'))
            ->add('municipioFk',EntityType::class, array( 'class' => 'AppBundle:Municipio', 'choice_label' => 'nombre', 'label' => 'Municipio'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pacientes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_pacientes';
    }


}
