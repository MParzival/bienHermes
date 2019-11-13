<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Goods;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoodsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('content')
            ->add('featured_image')
            ->add('users', EntityType::class,[
                'choice_label' => 'username',
                'class' => User::class
            ])
            ->add('keywords')
            ->add('categories', EntityType::class, [
                'choice_label' => 'label',
                'class' => Category::class
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Goods::class,
        ]);
    }
}
