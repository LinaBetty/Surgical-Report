<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('folio')
            ->add('edadPaciente', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class, array('label' => 'Edad del Paciente'))
            ->add('salon', ChoiceType::class, array('label' => 'Salón', 'choices' => array(
                'A' => 'A',
                'B' => 'B',
                'C'=> 'C',)))
            ->add('reintervencion', CheckboxType::class, array('label' => 'Reintervención'))
//            ->add('cirugiaCardiacaPrevia')
            ->add('numeroCirugiaPrevia', NumberType::class, array('label' => 'Número de Cirugías Cardíacas Previas'))
            ->add('descripcionActoOperatorio', TextareaType::class, array('label' => 'Descripción del Acto Operatorio'))
            ->add('accidentesOcurridos', TextareaType::class, array('label' => 'Accidentes Ocurridos'))
            ->add('pensamientoAortico', NumberType::class, array('label' => 'Pensamiento Aórtico'))
            ->add('tparoAnoxico', NumberType::class, array('label' => 'Tiempo de Paro Anóxico'))
            ->add('tbypassTotal', NumberType::class, array('label' => 'Tiempo de Bypass Total'))
            ->add('tbypassParcial', NumberType::class, array('label' => 'Tiempo de Bypass Parcial'))
            ->add('tbypassApoyo', NumberType::class, array('label' => 'Tiempo de Bypass de Apoyo'))
            ->add('noCardioplegias', NumberType::class, array('label' => 'Número de Cardioplegias'))
            ->add('trm', NumberType::class, array('label' => 'Temperatura Rectal Minima'))
            ->add('suturasEmpleadas',TextareaType::class, array('label' => 'Suturas Empleadas'))
            ->add('drenajes', TextareaType::class, array('label' => 'Drenajes'))
            ->add('viaExteorizacionDrenaje', TextareaType::class, array('label' => 'Vía de Exteorización del Drenaje'))
            ->add('otrasOperaciones', TextareaType::class, array('label' => 'Otras Operaciones'))
            ->add('diagnosticoOperatorio', TextareaType::class, array('label' => 'Diagnóstico Operatorio'))
            ->add('piezasEnviadasAp', TextareaType::class, array('label' => 'Piezas Enviadas a Anatomía Patológica'))
            ->add('muestrasEnviadasLab', TextareaType::class, array('label' => 'Muestras Enviadas al Laboratorio'))
            ->add('totalLiquidoAdministrado', NumberType::class, array('label' => 'Total de Líquido Administrado'))
            ->add('cantLiquidoAspirador', NumberType::class, array('label' => 'Cantidad de Líquido en el Aspirador'))
            ->add('sangre', NumberType::class, array('label' => 'Sangre'))
            ->add('globulos', NumberType::class, array('label' => 'Glóbulos'))
            ->add('plasma')
            ->add('dextrosa')
            ->add('electrolitosDextran', NumberType::class, array('label' => 'Electrolitos Dextran'))
            ->add('clna', NumberType::class, array('label' => 'CLNA'))
            ->add('cantCompresasG', NumberType::class, array('label' => 'Cantidad de Compresas Grandes'))
            ->add('cantCompresasMc', NumberType::class, array('label' => 'Cantidad de Compresas Medianas Completas'))
            ->add('cantCompresasCh', NumberType::class, array('label' => 'Cantidad de Compresas Chicas'))
            ->add('instrumentalCompleto', CheckboxType::class, array('label' => 'Instrumental Completo'))
            ->add('tiempoQuirurgico', TimeType::class, array('label' => 'Tiempo Quirúrgico'))
            ->add('pulso')
            ->add('tensionArterial')
            ->add('fechaInicio', DateType::class, array('widget' => 'single_text', 'label' => 'Fecha Inicio'))
            ->add('fechaFin', DateType::class, array('widget' => 'single_text', 'label' => 'Fecha Fin'))
            ->add('horaInicio', TimeType::class, array('widget' => 'single_text','html5' => 'false', 'label' => 'Hora Inicio'))
            ->add('horaFin', TimeType::class, array('widget' => 'single_text','html5' => 'false', 'label' => 'Hora Fin'))
            ->add('cama')
            ->add('fechaElaboracion', DateType::class, array('widget' => 'single_text', 'label' => 'Fecha de Elaboación del Informe'))
//            ->add('estadoSalirSalonFk')
//            ->add('tipoProtesisFk')
//            ->add('operacionRealizadaFk')
//            ->add('diagnosticoClinicoFk')
//            ->add('respiracionFk')
//            ->add('reflejosFk')
//            ->add('medicoAsistenciaFk')
//            ->add('salaFk')
//            ->add('enfermeraFk')
//            ->add('agenteAnestesicoFk')
//            ->add('metodoAnestesicoFk')
//            ->add('primerAyudanteFk')
//            ->add('anestesistaFk')
//            ->add('cirujanoFk')
//            ->add('perfusionistaFk')
//            ->add('clasifOperTipo1Fk')
//            ->add('codificacionFk')
//            ->add('clasifOperTipo3Fk')
//            ->add('clasifOperTipo2Fk')
//            ->add('pacienteFk');
            ->add('estadoSalirSalonFk', EntityType::class, array('class' => 'AppBundle:EstadoSalirSalon', 'choice_label' => 'nombre', 'label' => 'Estado al Salir del Salón'))
//            ->add('tipoProtesisFk')
            ->add('tipoProtesisFk', EntityType::class, array('class' => 'AppBundle:TipoProtesis', 'choice_label' => 'nombre', 'label' => 'Tipo de Prótesis'))
//            ->add('operacionRealizadaFk')
            ->add('operacionRealizadaFk', EntityType::class, array('class' => 'AppBundle:OperacionRealizada', 'choice_label' => 'nombre', 'label' => 'Opreación Realizada'))
//            ->add('diagnosticoClinicoFk')
            ->add('diagnosticoClinicoFk', EntityType::class, array('class' => 'AppBundle:DiagnosticoClinico', 'choice_label' => 'nombre', 'label' => 'Diagnóstico Clínico'))
//            ->add('respiracionFk')
            ->add('respiracionFk', EntityType::class, array('class' => 'AppBundle:Respiracion', 'choice_label' => 'nombre', 'label' => 'Respiración'))
//            ->add('reflejosFk')
            ->add('reflejosFk', EntityType::class, array('class' => 'AppBundle:Reflejos', 'choice_label' => 'nombre', 'label' => 'Reflejos'))
//            ->add('medicoAsistenciaFk')
//            ->add('medicoAsistenciaFk',EntityType::class, array( 'class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Médico de Asistencia'))
//            ->add('salaFk')
            ->add('salaFk', EntityType::class, array('class' => 'AppBundle:Sala', 'choice_label' => 'nombre', 'label' => 'Sala'))
//            ->add('enfermeraFk')
            ->add('enfermeraFk', EntityType::class, array('class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Enfermera'))
//            ->add('agenteAnestesicoFk')
            ->add('agenteAnestesicoFk', EntityType::class, array('class' => 'AppBundle:AgenteAnestesico', 'choice_label' => 'nombre', 'label' => 'Agente Anéstesico'))
//            ->add('metodoAnestesicoFk')
            ->add('metodoAnestesicoFk', EntityType::class, array('class' => 'AppBundle:MetodoAnestesico', 'choice_label' => 'nombre', 'label' => 'Método Anéstesico'))
//            ->add('primerAyudanteFk')
            ->add('primerAyudanteFk', EntityType::class, array('class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Primer Ayudante'))
//            ->add('anestesistaFk')
            ->add('anestesistaFk', EntityType::class, array('class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Anestecista'))
//            ->add('cirujanoFk')
            ->add('cirujanoFk', EntityType::class, array('class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Cirujano'))
//            ->add('pacienteFk')
            ->add('pacienteFk', EntityType::class, array('class' => 'AppBundle:Pacientes', 'choice_label' => 'nombreCompleto', 'label' => 'Paciente'))
//            ->add('perfusionistaFk')
            ->add('perfusionistaFk', EntityType::class, array('class' => 'AppBundle:Personal', 'choice_label' => 'nombre', 'label' => 'Perfusionista'))
//            ->add('clasifOperTipo1Fk')
            ->add('clasifOperTipo1Fk', EntityType::class, array('class' => 'AppBundle:ClasifOperTipo1', 'choice_label' => 'nombre', 'label' => 'Clasificación de Operación'))
//            ->add('codificacionFk')
            ->add('codificacionFk', EntityType::class, array('class' => 'AppBundle:Codificacion', 'choice_label' => 'nombre', 'label' => 'Codificación'))
//            ->add('clasifOperTipo3Fk')
            ->add('clasifOperTipo3Fk', EntityType::class, array('class' => 'AppBundle:ClasifOperTipo3', 'choice_label' => 'nombre', 'label' => 'Clasificación de Operación'))
//            ->add('clasifOperTipo2Fk')
            ->add('clasifOperTipo2Fk', EntityType::class, array('class' => 'AppBundle:ClasifOperTipo2', 'choice_label' => 'nombre', 'label' => 'Clasificación de Operación'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Operacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_operacion';
    }


}
