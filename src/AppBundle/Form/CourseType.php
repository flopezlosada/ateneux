<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Nombre '))
            ->add('start_date',TextType::class, array('label'=>'Fecha de inicio', 'attr'=>array('class'=>'datepicker form-control')))
            ->add('end_date',TextType::class, array('label'=>'Fecha de finalización', 'attr'=>array('class'=>'datepicker2 form-control')))
            ->add('course_type', null, array('label' => 'Tipo de curso'))
            ->add('mentor_teacher', null, array('label' => 'Indica la tutora o tutor del curso'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Course'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_course';
    }


}
