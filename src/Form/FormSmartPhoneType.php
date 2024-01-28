<?php
namespace App\Form;

use App\Entity\Categories;
use App\Entity\SmartPhone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FormSmartPhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[ 'placeholder'=>'Modele de Telephone','class'=>'form-control w-50  m-5']])

            ->add('prix',NumberType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'Prix €','class'=>'form-control w-50 m-5 ']])

            ->add('tailleEcran',TextType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'Taille d\'ecran','class'=>'form-control w-50  m-5']])

            ->add('systemeExploitation',TextType::class,[
                'label'=>false,
                'attr'=>[ 'placeholder'=>'systemeExploitation','class'=>'form-control w-50 m-5' ]])

            ->add('photoVideo',TextType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'photo & Video','class'=>'form-control w-50 m-5']])
            ->add('batterie',TextType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'batterie','class'=>'form-control w-50 m-5']])

            ->add('connectivite',TextType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'connectivite','class'=>'form-control w-50 m-5'] ])

            ->add('Capacite',TextType::class,[
                'label'=>false,
                'attr'=>['placeholder'=>'capacité','class'=>'form-control w-50 m-5' ]])

            ->add('imageFile',VichImageType::class,[
                
               'label_attr'=>[
                'style'=>'display:none'
               ],
                'attr'=>[
                    'class'=>'form-control ms-5 w-50'
                    
                ]
                
            ])
                ->add('smartPhoneCategorie',EntityType::class,[ 'label'=>false, 'required'=> false,'class' => Categories::class,
                'expanded'=> true, 'multiple'=> true,  'attr'=>[ 'class'=>'form-control   mt-2    bg-transparent border-0 ']])    

            ->add('save', SubmitType::class, [
                 'label'=>'enregistrer',
                'attr'=>['class'=>'form-control w-25  bg-primary m-5' ]]);;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([ 'data_class' => SmartPhone::class,
        ]);
    }
}
