<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Email',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your Number phone should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 180, ]),
                     ],'attr'=>[ 'class'=>'form-control  w-50' ]
            ])

              
           
            ->add('roles', ChoiceType::class, [
                'attr'=>[
                    'class'=>'form-control w-50',
                    'label'=>'Roles'
                ],
                'choices' => ['ROLE_ADMIN'=>'ROLE_ADMIN' ,'ROLE_USER'=>'ROLE_USER'],
                'expanded' => true,
                'multiple' => true,
            ],
        )

       
            ->add('firstName',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter firstName',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your Number phone should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 50, ]),
                     ],'attr'=>[ 'class'=>'form-control w-50' ]
            ])
            ->add('lastName',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter lastName',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your Number phone should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 50, ]),
                     ],'attr'=>[ 'class'=>'form-control w-50' ]
            ])
            ->add('adressePostale',TextType::class,[
                'attr'=>[
                    'class'=>'form-control w-50'
                ]
            ])
            ->add('NumberPhone',NumberType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a Number Phone',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your Number phone should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 14, ]),
                     ],'attr'=>[ 'class'=>'form-control w-50 ' ]
            ])
               
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,]),],
                'attr'=>['class'=>'form-control ']
            ])

            ->add('submit',SubmitType::class,[
                'label'=>'Modifier',
                'attr'=>[
                    'class'=>'form-control bg-warning w-25 mt-2 mb-2'
                ]
            ])
             //->add('password',PasswordType::class,)
            //->add('create_at')
           // ->add('accessoires')
           // ->add('contactClient')
           // ->add('ordinateurs')
           //->add('smartPhones')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
