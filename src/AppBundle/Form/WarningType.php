<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarningType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('date',TextType::class, array('label'=>'Fecha', 'attr'=>array('class'=>'datepicker form-control')))
            ->add('information', null, array('label' => 'Información','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('signed',null, array('label' => '¿Ha devuelto firmado la incidencia?'))
            ->add('description', null, array('label' => 'Descripción del hecho','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('penalty_start_date',TextType::class, array('label'=>'Fecha Inicio de sanción', 'attr'=>array('class'=>'datepicker2 form-control')))
            ->add('penalty_end_date',TextType::class, array('label'=>'Fecha Fin de sanción', 'attr'=>array('class'=>'datepicker3 form-control')))
            ->add('warning_type',null,array('label'=>'Tipo de incidencia'))
            ->add('teacher',null,array('label'=>'Profesora/or'))
            //->add('warning_cause_type',null,array('label'=>'Motivo de amonestación'))
            ->add('major_offence_type',null,array('label'=>'Tipo de falta grave'))
            ->add('penalty_type',null,array('label'=>'Tipo de sanción'))
            ->add('sai',null, array('label' => '¿Acude a la SAI?'))
            ->add('sai_observations', null, array('label' => 'Resumen de la estancia en la SAI','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('sai_teacher',null,array('label'=>'Profesora/or de guardia en la SAI'))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Warning'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_warning';
    }


}
