<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Advice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('message')
            ->remove('name')
            ->add('response')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class_activity' => Activity::class,
            'data_class_advice' => Advice::class,

        ]);
    }
}
