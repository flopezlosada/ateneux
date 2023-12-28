<?php

namespace AppBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StudentType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('birth_date',TextType::class, array('label'=>'Fecha de nacimiento','required'=>false, 'attr'=>array('class'=>'datepicker form-control')))
            ->add('nia', null, array('label' => 'NIA'))
            ->add('name', null, array('label' => 'Nombre'))
            ->add('surname', null, array('label' => 'Apellidos'))
            ->add('address', null, array('label' => 'Dirección'))
            ->add('postal_code', null, array('label' => 'Código Postal'))
            ->add('phone', null, array('label' => 'Teléfono'))
            ->add('celular', null, array('label' => 'Móvil'))
            ->add('email', null, array('label' => 'Correo electrónico'))
            ->add('observations', null, array('label' => 'Notas'))
            ->add('file', null, array(
                "required" => null === $builder->getData()->getId() ? false : false,
                "label" => "Imagen"
            ))

            ->add('state', EntityType::class, array("label" => "Provincia",'required'=>false, 'placeholder' => 'Selecciona Provincia', 'class' => 'AppBundle\Entity\State',
                'query_builder' => function (EntityRepository $er)
                {
                    return $er->createQueryBuilder('u')->where('u.id = :id')->setParameter("id", 32);

                }))
            ->add('city', EntityType::class, array("label" => "Ciudad",'required'=>false, 'placeholder' => 'Selecciona Ciudad', 'class' => 'AppBundle\Entity\City',
                'query_builder' => function (EntityRepository $er)
                {
                    return $er->createQueryBuilder('u')->where('u.state = :state')->setParameter("state", 32)->orderBy('u.name');

                }));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Student'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_student';
    }


}
