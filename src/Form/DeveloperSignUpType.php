<?php

namespace App\Form;

use App\Entity\Developer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeveloperSignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('developerName')
            ->add('description')
            ->add('socialNetwork')
            ->add('email')
            ->add('photoFileName')
            ->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Developer::class,
        ]);
    }
}
