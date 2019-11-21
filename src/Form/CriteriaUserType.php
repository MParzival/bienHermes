<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Alert;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CriteriaUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', MoneyType::class,[
                'label' => false,
                'currency' => 'EUR',
                'attr' => [
                    'placeholder' => 'Budget max'
                ]
            ])
            ->add('postalCode', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Code postal'
                ]
            ])
            ->add('activity', EntityType::class,[
                'choice_label' => 'name',
                'class' => Activity::class,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Activité'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Alert::class,
        ]);
    }
}
