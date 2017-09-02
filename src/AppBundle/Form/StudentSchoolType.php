<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentSchoolType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('repeat_grade', ChoiceType::class, array('label' => '¿Repite curso?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('adapted', ChoiceType::class, array('label' => '¿Presenta adaptación?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('advance_with_fail', ChoiceType::class, array('label' => '¿Promociona con asignaturas suspensas?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('fail_subject', null, array('label' => 'Indica qué asignaturas tiene suspensas'))
            ->add('responsible', ChoiceType::class, array('label' => '¿Es responsable?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('driven', ChoiceType::class, array('label' => '¿Está motivada/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('attentive', ChoiceType::class, array('label' => '¿Está atenta/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('thoughtful', ChoiceType::class, array('label' => '¿Es reflexiva/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('independent', ChoiceType::class, array('label' => '¿Es independiente?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('organized', ChoiceType::class, array('label' => '¿Es organizada/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('demotivated', ChoiceType::class, array('label' => '¿Está desmotivada/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('carefree', ChoiceType::class, array('label' => '¿Es despreocupada/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('distracted', ChoiceType::class, array('label' => '¿Es distraída/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('impulsive', ChoiceType::class, array('label' => '¿Es impulsiva/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('dependent', ChoiceType::class, array('label' => '¿Es dependiente?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('disorganized', ChoiceType::class, array('label' => '¿Es desorganizada/o?',
                'choices' => array(
                   'Sí' => 1,
                    'No' => 2,
                    'Sin definir' => 0)))
            ->add('reading_comprehension',null, array('label' => '¿Comprensión lectora?'))
            ->add('oral', null, array('label' => '¿Comprensión oral?'))
            ->add('written', null, array('label' => '¿Expresión escrita?'))
            ->add('oral_expression', null, array('label' => '¿Expresión oral?'))
            ->add('calculation', null, array('label' => '¿Cálculo?'))
            ->add('troubleshooting', null, array('label' => '¿Resolución de problemas?'))
            ->add('spelling', null, array('label' => '¿Ortografía?'))
            ->add('vocabulary', null, array('label' => '¿Vocabulario?'))
            ->add('attention', ChoiceType::class, array(
                'label' => 'Define su interés por el aprendizaje',
                'choices' => array(
                    'Sin definir' => 0,
                    'Bueno' => 'good',
                    'Apropiado' => 'appropriate',
                    'Problemático' => 'problem',
                ),
            ))
            ->add('student_relationship', ChoiceType::class, array(
                'label' => 'Define su relación con sus compañeras/os',
                'choices' => array(
                    'Sin definir' => 0,
                    'Buena' => 'good',
                    'Apropiada' => 'appropriate',
                    'Problemática' => 'problem',
                ),
            ))
            ->add('teacher_relationship', ChoiceType::class, array(
                'label' => 'Define su relación con sus profesoras/es',
                'choices' => array(
                    'Sin definir' => 0,
                    'Buena' => 'good',
                    'Apropiada' => 'appropriate',
                    'Problemática' => 'problem',
                ),
            ))
            ->add('work_habits', ChoiceType::class, array(
                'label' => 'Define sus hábitos de trabajo',
                'choices' => array(
                    'Sin definir' => 0,
                    'Buenos' => 'good',
                    'Apropiados' => 'appropriate',
                    'Problemáticos' => 'problem',
                ),
            ))
            ->add('study_habits', ChoiceType::class, array(
                'label' => 'Define sus hábitos de estudio',
                'choices' => array(
                    'Sin definir' => 0,
                    'Buenos' => 'good',
                    'Apropiados' => 'appropriate',
                    'Problemáticos' => 'problem',
                ),
            ))
            ->add('behavior', ChoiceType::class, array(
                'label' => 'Define su comportamiento',
                'choices' => array(
                    'Sin definir' => 0,
                    'Bueno' => 'good',
                    'Apropiado' => 'appropriate',
                    'Problemático' => 'problem',
                ),
            ))
            ->add('observations', null, array('label' => 'Observaciones'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\StudentSchool'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studentschool';
    }


}
