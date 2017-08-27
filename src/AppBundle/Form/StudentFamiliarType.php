<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentFamiliarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accept', null, array('label' => '¿Aceptan la situación hijo?'))
            ->add('acneae', null, array('label' => '¿Conocen las causas ACNEAE?'))
            ->add('protection', null, array('label' => '¿Presenta excesiva protección?'))
            ->add('increase', null, array('label' => '¿Refuerzan logros?'))
            ->add('punish', null, array('label' => '¿Castigan conductas disruptivas?'))
            ->add('converse', null, array('label' => '¿Dialogan con su hijo/a?'))
            ->add('cooperate', null, array('label' => '¿Presentan colaboración?'))
            ->add('meeting', null, array('label' => '¿Demandan reuniones al tutor?'))
            ->add('mentor', null, array('label' => '¿Colaboran sólo si el tutor lo pide?'))
            ->add('study_time', null, array('label' => '¿Organizan tiempo de estudio?'))
            ->add('learning', null, array('label' => '¿Refuerzan aprendizaje?'))
            ->add('work_control', null, array('label' => '¿Controlan trabajo diario?'))
            ->add('study_control', null, array('label' => '¿Controlan estudio diario?'))
            ->add('familiar_people', null, array('label' => 'Indica las personas que conviven en el seno familiar'))
            ->add('observations', null, array('label' => 'Observaciones'))
            ->add('death', ChoiceType::class, array(
                'label' => 'Indica si ha habido algún progenitora/or fallecida/o',
                'choices' => array(
                    'Ningunx' => null,
                    'Madre' => 'female',
                    'Padre' => 'male',
                    'Ambxs' => 'both',
                ),
            ))
            ->add('unemployment', ChoiceType::class, array(
                'label' => 'Indica si hay algún progenitora/or en paro',
                'choices' => array(
                    'Ningunx' => null,
                    'Madre' => 'female',
                    'Padre' => 'male',
                    'Ambxs' => 'both',
                ),
            ))
            ->add('care', ChoiceType::class, array(
                'label' => '¿Custiodia de progenitorxs separadxs?',
                'choices' => array(
                    'Sin definir' => null,
                    'Madre' => 'female',
                    'Padre' => 'male',
                    'Ambxs' => 'both',
                    'Abuelxs'=>'grandparents',
                    'Otros' => 'others'
                ),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\StudentFamiliar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studentfamiliar';
    }


}
