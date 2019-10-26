<?php

namespace App\Form;

use App\Entity\BienSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label'=> false,
                'attr' => [
                    'placeholder' => 'Prix maximal'
                ]
            ])
//            ->add('minSurface', IntegerType::class, [
//                'required' => false,
//                'label'=> false,
//                'attr' => [
//                    'placeholder' => 'Surface minimal'
//                ]
//            ])
            /*->add('nom', TextType::class, [
                 'required' => false,
                 'label'=> false,
                 'attr' => [
                     'placeholder' => 'Recherche par nom'
                 ]
             ])
             ->add('codePostal', TextType::class, [
                 'required' => false,
                 'label'=> false,
                 'attr' => [
                     'placeholder' => 'Recherche par code postal'
                 ]
             ])*/;
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
