<?php

namespace App\Form;

use App\Entity\Actuality;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre de l'annonce",
            ])
            ->add('resume', TextType::class,[
                'label' => "Résumé",
            ])
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('content',CKEditorType::class,[
                'label' => 'Contenu',
                'config' =>[
                    'uiColor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true
                ]
            ])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actuality::class,
        ]);
    }
}
