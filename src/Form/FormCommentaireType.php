<?php

namespace App\Form;

use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormCommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentaire', TextareaType::class,[
                'label'=>false,
                'attr'=>[
                  
                   'placeholder'=>'commenter......',
                    'class'=>'form-controle w-50 mt-5 ms-5 '
                ]
            ])
            ->add('Note', ChoiceType::class, [
                'label'=>false,
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    
                ], 
                'attr'=>[
                    'class'=>'form-control  w-100 ms-5 mt-1 me-5 ',
                    'placeholder' => 'Note'],
            ])
         
            ->add('submit',SubmitType::class,[
                
                'attr'=>[
                 'class'=>'form-control w-100 mt-1 ms-5 bg-primary',
                 'placeholder'=>'envoyer'
                ]
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaires::class,
        ]);
    }
}
