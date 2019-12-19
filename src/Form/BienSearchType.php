<?php

namespace App\Form;

use App\Entity\BienSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postalCode', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'par code postal...'
                ]
            ])
            ->add('maxPrice', MoneyType::class, [
                'required' => false,
                'label'=> false,
                'currency' => 'EUR',
                'attr' => [
                    'placeholder' => 'Budget max'
                ]
            ])
            ->add('activite', TextType::class, [
                'required' => false,
                'label'=> false,
                'attr' => [
                    'placeholder' => 'Par activité...'
                ]
            ])
            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface minimal...'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BienSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
