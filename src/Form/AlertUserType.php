<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\AlertUser;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlertUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice')
            ->add('postalCode')
            ->add('idActivity', EntityType::class,[
                'choice_label' => 'name',
                'class' => Activity::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AlertUser::class,
        ]);
    }
}
