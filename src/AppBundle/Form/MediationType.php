<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accept_first_student', null, array('label'=>"¿Acepta Mediación?"))
            ->add('accept_second_student', null, array('label'=>"¿Acepta Mediación?"))
            ->add('date', TextType::class, array('label' => 'Fecha de la mediación', 'attr' => array('class' => 'datepicker form-control')))
            ->add('first_student_observations', null, array('label' => 'Descripción de los hechos', 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')))
            ->add('second_student_observations', null, array('label' => 'Descripción de los hechos', 'attr' => array('class' => 'tinymce', 'data-theme' => 'simple')))
            ->add('deals', null, array('label' => 'Información', 'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')))
            ->add('student_mediator', EntityType::class, array("label" => "Estudiante mediadora/or", 'placeholder' => 'Selecciona Estudiante', 'class' => 'AppBundle\Entity\Student',  'required'=>false,
                'query_builder' => function (EntityRepository $er) {

                    return $er->createQueryBuilder('u')->where('u.is_mediator=1');
                }

            ))
            ->add('teacher_mediator', EntityType::class, array("label" => "Profesora/or mediadora/or", 'placeholder' => 'Selecciona Profesora/or', 'class' => 'AppBundle\Entity\Teacher', 'required'=>false,
                'query_builder' => function (EntityRepository $er) {

                    return $er->createQueryBuilder('u')->where('u.is_mediator=1');
                }

            ))


        ;

    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mediation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_mediation';
    }


}
