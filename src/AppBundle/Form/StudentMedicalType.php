<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentMedicalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('allergy', null, array('label' => 'Tiene algún tipo de alergia'))
            ->add('allergy_observations', null, array('label' => 'Observaciones sobre alergias'))
            ->add('disease', null, array('label' => 'Tiene algún tipo de enfermedad'))
            ->add('disease_observations', null, array('label' => 'Observaciones sobre enfermedades'))
            ->add('handicap', null, array('label' => 'Tiene algún tipo de déficit'))
            ->add('handicap_observations', null, array('label' => 'Observaciones sobre déficits'))
            ->add('tdah', null, array('label' => 'Tiene TDAH'))
            ->add('medical_treatment', null, array('label' => 'Sigue algún tratamiento médico'))
            ->add('psychological_treatment', null, array('label' => 'Sigue algún proceso terapéutico'))
            ->add('observations', null, array('label' => 'Otras observaciones'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\StudentMedical'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studentmedical';
    }


}
