<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Ordinateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormOrdinateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Nom Ordinateur',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('prix',NumberType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Prix €',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('tailleEcran',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Taille de l\'écran',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('systemeExploitation',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'systemeExploitation',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('photoVideo',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'photo &video',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('batterie', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'batterie',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('connectivite', TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'connectivite',
                    'class'=>'form-control w-50 m-4'
                ]
            ])
            ->add('image',VichImageType::class,[
                'label_attr'=>[
                    'style'=>'display:none'
                   ],
                'attr'=>[
                    'class'=>'form-control w-50 m-5'
                ]
            ])

            ->add('ordinateurcategory',EntityType::class,[ 'label'=>false, 'required'=> false,'class' => Categories::class,
            'expanded'=> true, 'multiple'=> true,  'attr'=>[
                    'class'=>'form-control   mt-2    bg-transparent border-0 ']])    

         ->add('save', SubmitType::class, [
             'label'=>'enregistrer',
             'attr'=>[
                          
             'class'=>'form-control w-25  bg-primary m-5'
                       ]
                   ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ordinateur::class,
        ]);
    }
}
