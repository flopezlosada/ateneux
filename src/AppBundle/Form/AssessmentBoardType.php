<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssessmentBoardType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',TextType::class, array('label'=>'Fecha', 'attr'=>array('class'=>'datepicker form-control')))
            ->add('information', null, array('label' => 'Valoración general del grupo','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('learning_difficulties', null, array('label' => 'Estudiantes con dificultades académicas','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('coexistence_difficulties', null, array('label' => 'Estudiantes con dificultades de convivencia','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('support', null, array('label' => 'Estudiantes que precisan algún tipo de apoyo','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('family_date', null, array('label' => 'Estudiantes cuyos padres debe citar la/el tutora/or de forma inmediata','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('change_optional', null, array('label' => 'Estudiantes que deben cambiar de optativa','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('other_interesting', null, array('label' => 'Otras cuestiones de interés para Jefatura de Estudios o Dpto. de Orientación','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('assessment_type',null,array('label'=>'Evaluación'))
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\AssessmentBoard'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_assessmentboard';
    }


}
