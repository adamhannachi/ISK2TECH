<?php

namespace App\Form;

use App\Entity\ContactClient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'attr'=>['placeholder' =>'Adresse Email...','class'=>'form-control  w-50']])

            ->add('lastName', TextType::class,['attr'=>['placeholder' =>'Nom de famille','class'=>'form-control  w-50'
                ]])

            ->add('numberPhone', NumberType::class,[
                'attr'=>['placeholder' =>'Numero de Téléphone','class'=>'form-control  w-50'
                ]
            ])
            ->add('sujet' ,TextType::class,[
                'attr'=>[ 'placeholder' =>'sujet', 'class'=>'form-control  w-50']
            ])
            ->add('contenu', TextareaType::class,[
                'attr'=>[ 'placeholder' =>'contenu....', 'class'=>'form-control  w-50' ]
            ])
            ->add('submit',SubmitType::class,[
                'attr'=>['placeholder' =>'envoyer','class'=>'form-control  w-50 mt-2 mb-2 bg-primary text-light ']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactClient::class,
        ]);
    }
}
