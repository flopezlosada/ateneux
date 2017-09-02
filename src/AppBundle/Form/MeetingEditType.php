<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetingEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',TextType::class, array('label'=>'Fecha de la reunión', 'attr'=>array('class'=>'datepicker form-control')))
            ->add('title', null, array('label' => 'Título'))
            ->add('handle_issues', null, array('label' => 'Asuntos tratados','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('deals', null, array('label' => 'Acuerdos','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
            ->add('observations', null, array('label' => 'Observaciones','attr'=>array('class'=>'tinymce','data-theme'=>'advanced')))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Meeting'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_meeting';
    }


}
