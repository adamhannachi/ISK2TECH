<?php

namespace App\Form;

use App\Entity\Accessoires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FormAccessoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[
                'placeholder'=>"Nom d'accessoire",
                'class'=>'formcontrol w-50 m-4'
                ]
            ])
            ->add('prix', NumberType::class,[
                'label'=>false,
                'attr'=>[
                'placeholder'=>"Prix €",
                'class'=>'formcontrol w-50 m-4'
                ]
            ])
            ->add('couleur',TextType::class,[
                'label'=>false,
                'attr'=>[
                'placeholder'=>"couleur",
                'class'=>'formcontrol w-50 m-4'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label'=>false,
                'attr'=>[
                'placeholder'=>"Description",
                'class'=>'formcontrol w-50 m-4'
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
            
           ->add('submit',SubmitType::class,[
            'label'=>'enregistrer',
                'attr'=>[
                    
                    'class'=>'form-control  w-25 mt-2 mb-2 bg-primary text-light '
                ]
            ])

           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accessoires::class,
        ]);
    }
}
