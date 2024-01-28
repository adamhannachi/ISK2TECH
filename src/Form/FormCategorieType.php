<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom' ,TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Marque de produit',
                    'class'=>'form-control w-75  ms-5',
                    'minlength'=>'3',
                    'maxlength'=>'50',
                ]
            ])
           

            ->add('submit',SubmitType::class,[
               'attr'=>[
                'class'=>'form-control w-25 mt-1 ms-5 bg-primary ',
                'placeholder'=>'enregistrer'
               ]
            ])
           ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
