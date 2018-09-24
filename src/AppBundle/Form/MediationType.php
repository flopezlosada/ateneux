<?php

namespace AppBundle\Form;

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
            ->add('accept_first_student')
            ->add('accept_second_student')
            ->add('first_student_observations', null, array('label' => 'Información','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('second_student_observations', null, array('label' => 'Información','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('deals', null, array('label' => 'Información','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')));
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
